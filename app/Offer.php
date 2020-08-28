<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
     protected $fillable= [
    	'date_from',
    	'date_To',
    	'description',
    ];
}
