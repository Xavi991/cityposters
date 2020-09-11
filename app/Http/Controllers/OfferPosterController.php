<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Offer_Poster;
use App\Offer;
use App\Product;
use Auth;

class OfferPosterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product_id= Product::where('barcode',$request->ean)->pluck('id')->first();
        $user_id= Auth::user()->id;

        $offerPoster= new Offer_Poster;

        $offerPoster->date_from=                $request->date_from;            
        $offerPoster->date_to=                  $request->date_to;
        $offerPoster->description=              $request->description;
        $offerPoster->before_price=             $request->before_price;
        $offerPoster->after_price=              $request->after_price;
        $offerPoster->design_type=              $request->design_type;
        $offerPoster->descount_porcentage=      $request->descount_porcentage;
        $offerPoster->quantity_promo=           $request->quantity_promo;
        $offerPoster->group=                    $request->group;
        $offerPoster->group_tittle=             $request->group_tittle;   
        $offerPoster->product_id=               $product_id; 
        $offerPoster->user_id=                  $user_id; 
        $offerPoster->offer_header_id=          $request->offer_header_id;

        $offerPoster->save();

        return 'Exito';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $offerPoster= Offer_Poster::find($id);

        $offerPoster->date_from=                $request->date_from;            
        $offerPoster->date_to=                  $request->date_to;
        $offerPoster->description=              $request->description;
        $offerPoster->before_price=             $request->before_price;
        $offerPoster->after_price=              $request->after_price;
        $offerPoster->design_type=              $request->design_type;
        $offerPoster->descount_porcentage=      $request->descount_porcentage;
        $offerPoster->quantity_promo=           $request->quantity_promo;
        $offerPoster->group=                    $request->group;
        $offerPoster->group_tittle=             $request->group_tittle;   

        $offerPoster->update(); 

        return 'Exito';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
