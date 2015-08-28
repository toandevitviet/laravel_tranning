<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //List fields input request in tables need getvalue
    protected $fillable = [
        'product_name',
        'product_image',
        'product_price',
        'product_description',
        'created_at',
        'updated_at'
    ];
}
