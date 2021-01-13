<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'image_name',
        'description',
        'colors',
        'price',
        'discount',
        'tag',
        'category_id'
    ];

    
    public function categories()
    {
    	return $this->belongsToMany('App\Category','product_categories','product_id','category_id');
    }
    public function images()
    {
    	return $this->hasMany('App\ProductImage','product_id');
    }
    public function shops()
    {
    	return $this->belongsToMany('App\Shop','product_shops','product_id','shop_id');
    }
    public function attributes()
    {
    	return $this->hasMany('App\ProductAttribute','product_id');
    }
    
    
    
    
}
