<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;

use App\Offer_Poster;
use App\Image;
use App\Product;
use App\Imports\OffersImport;
use App\Offer;

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
    public function index()
    {
        $images= Image::get();

        return view('home')->with('images',$images);
    }

    public function getOffersPage(){
        $offer= Offer::orderBy('id','DESC')->first();

        return view('pages.offers')->with('offer',$offer);
    }

    public function getOfferPosters(){
        $offer_id= Offer::orderBy('id','DESC')->pluck('id')->first();
        
        return response()->json(
            new Offer_PosterCollection(
                Offer_Poster::where('offer_id',$offer_id)->get()
            )
        );

    }

    public function destroyOffer($id){

        $offer= Offer_Poster::findOrFail($id);
        $offer->delete();
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

    public function importExcel(Request $request){

        $validate= $this->validate($request,[
            'description'   => 'required|max:250',
            'dateFrom'      => 'required',
            'dateTo'        => 'required',
            'file'          => 'required|mimes:xlsx,xls'
        ]);

        $date_from= $request->input('dateFrom');
        $date_to= $request->input('dateTo');
        $description= $request->input('description');
        
        $offer= new Offer;
        $offer->date_from= $date_from;
        $offer->date_to= $date_to;
        $offer->description= $description;

        $offer->save();

        $file= $request->file('file');

       
        Excel::import(new OffersImport, $file);

        return back()->with('status', 'Importación de oferta completada.');
        
        
    }

    public function streamPdf(){
        $collection= null;
        $ean_group= null;

        //CARTEL ACTIVO
        $image= Image::where('active',true)->get();

        //ULTIMA OFERTA CREADA
        $offer_id= Offer::orderBy('id','DESC')->pluck('id')->first();

        //OFERTAS NORMALES
    
        $offers= DB::table('offer_posters as o') 
            ->join('products as p', 'o.product_id', '=', 'p.id')
            ->select(DB::raw('o.*, p.barcode as ean'))
            ->where('o.group', 'like', '0')
            ->where('o.offer_id',$offer_id)
            ->get();
    
        //OFERTAS GRUPALES ->where('o.group_tittle','like', 'T')
        $groups= DB::table('offer_posters as o') 
            ->select(DB::raw('o.*'))
            ->where('o.group', 'not like', '0')
            ->where('o.group_tittle', 'like', 'T')
            ->where('o.offer_id',$offer_id)
            ->get();

        if(count($groups)>0){
            $ean_group= DB::table('offer_posters as o')
            ->join('products as p', 'o.product_id', '=', 'p.id')
            ->select(DB::raw("o.group, STRING_AGG(p.barcode, ',') as ean"))
            ->where('o.group', 'not like', '0')
            ->where('o.offer_id',$offer_id)
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
        //return $pdf->download('OFERTAS.pdf');
    }


    public function downloadPdf(){
        $collection= null;
        $ean_group= null;

        //CARTEL ACTIVO
        $image= Image::where('active',true)->get();

        //ULTIMA OFERTA CREADA
        $offer_id= Offer::orderBy('id','DESC')->pluck('id')->first();

        //OFERTAS NORMALES
    
        $offers= DB::table('offer_posters as o') 
            ->join('products as p', 'o.product_id', '=', 'p.id')
            ->select(DB::raw('o.*, p.barcode as ean'))
            ->where('o.group', 'like', '0')
            ->where('o.offer_id',$offer_id)
            ->get();
    
        //OFERTAS GRUPALES ->where('o.group_tittle','like', 'T')
        $groups= DB::table('offer_posters as o') 
            ->select(DB::raw('o.*'))
            ->where('o.group', 'not like', '0')
            ->where('o.group_tittle', 'like', 'T')
            ->where('o.offer_id',$offer_id)
            ->get();

        if(count($groups)>0){
            $ean_group= DB::table('offer_posters as o')
            ->join('products as p', 'o.product_id', '=', 'p.id')
            ->select(DB::raw("o.group, STRING_AGG(p.barcode, ',') as ean"))
            ->where('o.group', 'not like', '0')
            ->where('o.offer_id',$offer_id)
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
        return $pdf->download("OFERTAS.pdf");
        //return $pdf->download('OFERTAS.pdf');
    }
}
