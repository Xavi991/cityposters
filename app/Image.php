<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	protected $fillable= ['image_path_name','active'];

	public $timestamps= false;

}
