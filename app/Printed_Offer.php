<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Printed_Offer extends Model
{
	protected $table= 'printed_offers';
    protected $fillable= [
    	'printed_date',
    	'quantity',
    	'user_id',
    	'site_id'
    ];

    public $timestamps = false;
    // protected $dates = ['date_from', 'date_to'];
}
