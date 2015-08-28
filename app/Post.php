<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //set title of blog post
    public function setTitleAttribute($value) 
    {
    	$this->attributes['title'] = $value;
    }
}
