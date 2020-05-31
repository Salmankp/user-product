<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Image;

class Product extends Model
{
    use SoftDeletes;
    public  function product_image()
    {
        return $this->belongsTo('App\Image','id','product_id')->latest();
    }
    public  function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
    public  function category()
    {
        return $this->belongsTo('App\Category','category_id','id');
    }
}
