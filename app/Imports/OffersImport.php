<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Throwable;

use Auth;
use App\Offer_Poster;
use App\Product;
use App\Offer;

//Implementar WithStartRow para empezar desde la 2da fila
class OffersImport implements ToModel,WithStartRow,SkipsOnError
{

    public function startRow(): int
    {
        return 2;
    }

    public function onError(Throwable $error){

    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $descount=0;
        $after_price=0;
        $quantity_promo=0;
        $group=0;
        $group_tittle='';
        $product_id=null;
        $offer_id= Offer::orderBy('id','DESC')->pluck('id')->first();

        if( is_null($row[2]) ){
            $product_id=null;

        }else{
            $product_id= Product::where('barcode', $row[2])->first()->id;
        }

        if( is_null($row[5]) ){
            $after_price= 0;
        }else{
            $after_price= $row[5];
        }

        if( is_null($row[6]) ){
            $descount= 0;
        }else{
            $descount= $row[6];
        }
        
        if( is_null($row[7]) ){
            $quantity_promo=0;
        }else{
            $quantity_promo= $row[7];
        }

        if( is_null($row[9]) ){
            $group=0;
        }else{
            $group= $row[9];
        }
        
        if( is_null($row[10]) ){
            $group_tittle='N';
        }else{
            $group_tittle= 'T';
        }

        $offer_poster =  new Offer_Poster([
            'date_from'     => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0])->format('Y-m-d'),
            'date_to'       => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1])->format('Y-m-d'),
            'description'           => $row[3],
            'before_price'          => $row[4],
            'after_price'           => $after_price,
            'descount_porcentage'   => $descount,
            'quantity_promo'        => $quantity_promo,
            'design_type'           => $row[8],
            'group'                 => $group,
            'group_tittle'          => $group_tittle,
            'product_id'            => $product_id,
            'user_id'               => Auth::user()->id,
            'offer_id'               => $offer_id,
            
        ]);
        $offer_poster->save();

        // $offer_group = new OfferGroup([
        //     'group'                 => $group,
        //     'offer_poster_id'       => $offer_poster->id,
        //     'product_id'            => $product_id
        // ]);
        
        // $offer_group->save();

        return $offer_poster;
    }
}
