<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;

use Auth;
use App\Offer_Poster;
use App\Image;
use App\Product;
use App\Imports\OffersImport;
use App\Site;
use App\OfferHeader;
use App\OfferSite;

use App\Http\Resources\Offer_Poster as Offer_PosterResources;
use App\Http\Resources\Offer_PosterCollection;

use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     * xlsx,doc,docx,ppt,pptx,ods,odt,odp
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() //NEW
    {
        $images= Image::orderBy('id','ASC')->get();
        $sites=  Site::select('id','description')->get();
        $offerHeaders=  OfferHeader::select('id','description')
                    ->where('date_to', '>=', date("Y-m-d"))->get();

        if(Auth::user()->isAdmin()){
            return view('home')
                    ->with('offerHeaders',$offerHeaders)
                    ->with('images',$images)
                    ->with('sites',$sites);
        }else{
           $collection= $this->guestOffersPage();
           return view('pages.guest_offer_header')->with('collection', $collection)->with('images', $images);
        }
       
    }

    public function createOfferHeader(Request $request){ //NEW
        $this->validate($request,[
            'description'   =>'required|max:250',
            'dateFrom'      => 'required',
            'dateTo'        => 'required',
            'sites'         => 'required',
        ]);

        $description= ucwords(strtolower($request->description));
        $slugFormat= strtolower($request->description);
        $slugFormat= str_slug($slugFormat)."-".rand(1,1000);

        $offerHeader= new OfferHeader;
        $offerHeader->date_from     = $request->dateFrom;
        $offerHeader->date_to       = $request->dateTo;
        $offerHeader->description   = $description;
        $offerHeader->slug          = $slugFormat;

        $offerHeader->save();

        $offerHeader_id= OfferHeader::orderBy('id','DESC')->pluck('id')->first();//SIEMPRE EL ULLTIMO

        foreach($request->sites as $site){
            OfferSite::create([
                'offer_header_id' =>$offerHeader_id,
                'site_id'         =>$site  
            ]);
        }

        return back()->with('status', 'Se ha creado la oferta correctamente!!');//NEW
    }

    public function importExcel(Request $request){  //NEW

        $validate= $this->validate($request,[
            'offerHeader'   => 'required',
            'file'          => 'required|mimes:xlsx,xls'
        ]);

        $offer_header_id= $request->input('offerHeader');
        
        $file= $request->file('file');

       
        Excel::import(new OffersImport($offer_header_id), $file);

        return back()->with('status', 'Importación de oferta completada.');
        
    }

    public function getOffersPage(){    //NEW
      
        $offers= DB::table('offer_headers as h') 
                ->select(DB::raw('h.id, h.date_from,h.date_to,h.description,h.slug'))
                ->where('date_to', '>=', date("Y-m-d"))
                ->get();


        $sites= DB::table('offer_headers as h') //STRING_AGG(s.description, ',')
            ->join('offer_sites as m', 'm.offer_header_id', '=', 'h.id')
            ->join('sites as s', 'm.site_id', '=', 's.id')
            ->select(DB::raw("h.id, GROUP_CONCAT(s.description) as description2"))
            ->where('h.date_to', '>=', date("Y-m-d"))
            ->groupBy('h.id')
            ->get();

        $collection= new Collection; //crear coleccion vacia

       if(count($offers)){
            for ($i=0; $i<count($offers); $i++) { //UNIR COLECIONES POR ID
                $valor=null;

                if($offers[$i]->id == $sites[$i]->id){
                    $valor= collect($offers[$i])->put('sites', $sites[$i]->description2);
                    $collection->push($valor);
                }
            }
       }

        return view('pages.offer_header')->with('collection',$collection);
    }

    public function guestOffersPage(){ //NEW
        $site_id= Auth::user()->site_id;
        
        $offers= DB::table('offer_headers as h') 
                 ->join('offer_sites as m', 'm.offer_header_id', '=', 'h.id')
                ->select(DB::raw('h.id, h.date_from,h.date_to,h.description,h.slug'))
                ->where('m.site_id', $site_id)
                ->where('date_to', '>=', date("Y-m-d"))
                ->get();


        $site= DB::table('offer_headers as h') 
            ->join('offer_sites as m', 'm.offer_header_id', '=', 'h.id')
            ->join('sites as s', 'm.site_id', '=', 's.id')
            ->select(DB::raw("h.id, s.description"))
            ->where('m.site_id', $site_id)
            ->where('h.date_to', '>=', date("Y-m-d"))
            ->get();

        $collection= new Collection; //crear coleccion vacia

       if(count($offers)){
            for ($i=0; $i<count($offers); $i++) { //UNIR COLECIONES POR ID
                $valor=null;

                if($offers[$i]->id == $site[$i]->id){
                    $valor= collect($offers[$i])->put('site', $site[$i]->description);
                    $collection->push($valor);
                }
            }
       }

        return $collection;
    }

    public function getOfferPosters($offer_id){ //NEW
      
        return response()->json(
            new Offer_PosterCollection(
                Offer_Poster::where('offer_header_id',$offer_id)->get()
            )
        )  ;

    }

    public function getDetail($slug){    //NEw
        $offerHeader= OfferHeader::where('slug',$slug)
                ->where('date_to', '>=', date("Y-m-d"))->first();


        return view('pages.offer_detail')->with('offerHeader',$offerHeader);
    }

    public function destroyOffer($id){

        $offer= Offer_Poster::findOrFail($id);
        $offer->delete();
    }

    public function destroyAll($id){ //NEW
        $offers= Offer_Poster::where('offer_header_id',$id)->get();
        $offerHeader= OfferHeader::find($id);

       if(count($offers) > 0){
            DB::table('offer_posters')->where('offer_header_id', $id)->delete();
            DB::table('offer_sites')->where('offer_header_id', $id)->delete();
            $offerHeader->delete();
        }else{
            DB::table('offer_sites')->where('offer_header_id', $id)->delete();
            $offerHeader->delete();
        }

        return back()->with('status', 'La oferta se eliminó correctamente!!');
    }

    public function importImage(Request $request){

        $image= new Image;

        $validate= $this->validate($request,[
            'image'=>'required|image'
        ]);

        $image_path= $request->file('image');
        
        if($image_path){
            $image_path_name= time().$image_path->getClientOriginalName();

            Storage::disk('public')->put($image_path_name, File::get($image_path));

            $image->image_path_name= $image_path_name;
            $image->created_at= date('Y-m-d H:i:s');
        }

        $image->save();

        return back()->with('status', 'Importación de cartel completada.');
    }

    public function getImage($filename){
        $image= Storage::disk('public')->get($filename);

        return $image;
    }

    public function destroyImage($id){
        
        $image= Image::find($id);
        //Storage::disk('posters')->delete($image->image_path_name);
        Storage::delete('public/'.$image->image_path_name);
        $image->delete();

        return back()->with('status', 'Se eliminó correctamente el cartel.');
    }

    public function activeDesign(Request $request){

        $validator= Validator::make($request->all(),[
            'inlineRadioOptions'=>'required'

        ],[
            'inlineRadioOptions.required'=>'Debe de seleccionar un diseño de cartel.'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator->errors());

        }else{
            DB::table('images')->update(['active' => 0]);

            $image= Image::find($request->inlineRadioOptions);

            $image->active = true;

            $image->update();

            return back()->with('default', 'Cartel seleccionado correctamente');
        }   

        
    }

    public function streamPdf($offer_id){
        $collection= null;
        $ean_group= null;

        //CARTEL ACTIVO
        $image= Image::where('active',true)->get();

        //ULTIMA OFERTA CREADA
        // $offer_id= Offer::orderBy('id','DESC')->pluck('id')->first();

        //OFERTAS NORMALES
    
        $offers= DB::table('offer_posters as o') 
            ->join('products as p', 'o.product_id', '=', 'p.id')
            ->select(DB::raw('o.*, p.barcode as ean'))
            ->where('o.offer_header_id',$offer_id)
            ->where('o.group', 'like', '0')
            ->get();
        
        //OFERTAS GRUPALES ->where('o.group_tittle','like', 'T')
        $groups= DB::table('offer_posters as o') 
            ->select(DB::raw('o.*'))
            ->where('o.offer_header_id',$offer_id)
            ->where('o.group', 'not like', '0')
            ->where('o.group_tittle', 'like', 'T')
            ->get();

        if(count($groups)>0){ //STRING_AGG(p.barcode, ',')  GROUP_CONCAT(p.barcode)
            $ean_group= DB::table('offer_posters as o')
            ->join('products as p', 'o.product_id', '=', 'p.id')
            ->select(DB::raw("o.group, GROUP_CONCAT(o.group_code) as ean"))
            ->where('o.offer_header_id',$offer_id)
            ->where('o.group', 'not like', '0')
            ->groupBy('o.group')->get();

            $collection= $offers->concat($groups);

        }else{
            $collection= $offers;
        }

        // $groups_ean_merge= $groups->map(function ($item, $key) {

        //     $ean_group= DB::table('offer_posters as o')
        //     ->join('products as p', 'o.product_id', '=', 'p.id')
        //     ->select(DB::raw('o.group, GROUP_CONCAT(p.barcode) as ean'))
        //     ->where('o.group', 'not like', '0')
        //     ->where('o.group',$item->group)
        //     ->groupBy('o.group')->get();

        //     return collect($item)->merge($ean_group);
        // });

         // dd($ean_group);

        $pdf = PDF::loadView('export.pdf', compact('image','collection','ean_group'));
        return $pdf->stream();
        
    }


    public function downloadPdf($offer_id){
        $collection= null;
        $ean_group= null;

        //CARTEL ACTIVO- SIN CARTEL PARA IMPRIMIR
        $image= [];

        //OFERTAS NORMALES
    
        $offers= DB::table('offer_posters as o') 
            ->join('products as p', 'o.product_id', '=', 'p.id')
            ->select(DB::raw('o.*, p.barcode as ean'))
            ->where('o.offer_header_id',$offer_id)
            ->where('o.group', 'like', '0')
            ->get();
        
        //OFERTAS GRUPALES ->where('o.group_tittle','like', 'T')
        $groups= DB::table('offer_posters as o') 
            ->select(DB::raw('o.*'))
            ->where('o.offer_header_id',$offer_id)
            ->where('o.group', 'not like', '0')
            ->where('o.group_tittle', 'like', 'T')
            ->get();

        if(count($groups)>0){ //GROUP_CONCAT(p.barcode)
            $ean_group= DB::table('offer_posters as o')
            ->join('products as p', 'o.product_id', '=', 'p.id')
            ->select(DB::raw("o.group, GROUP_CONCAT(o.group_code) as ean"))
            ->where('o.offer_header_id',$offer_id)
            ->where('o.group', 'not like', '0')
            ->groupBy('o.group')->get();

            $collection= $offers->concat($groups);
        }else{
            $collection= $offers;
        }

        $pdf = PDF::loadView('export.pdf', compact('image','collection','ean_group'));
        return $pdf->download("OFERTAS.pdf");
    }
}
