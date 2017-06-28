<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use User;

class Category extends Model
{
	protected $fillable=['name'];
    
    public function videos()
    {
    	return $this->belongsToMany('App\Video');
    }
}
