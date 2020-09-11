<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferHeader extends Model
{
    protected $fillable=[
    	'date_from',
    	'date_to',
    	'description',
    	'slug'
    ];
}
