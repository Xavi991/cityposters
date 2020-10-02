<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer_Poster extends Model
{	
	protected $table= 'offer_posters';
    protected $fillable= [
    	'date_from',
    	'date_to',
    	'description',
    	'before_price',
    	'after_price', 
    	'descount_porcentage',
    	'quantity_promo',
    	'design_type', 
        'group', 
        'group_tittle',
        'group_code',
        'product_id',
    	'user_id',
        'offer_header_id'
    ];

    protected $dates = ['date_from', 'date_to'];
    //,'poduct_id','user_id','descount_type_id'
}
