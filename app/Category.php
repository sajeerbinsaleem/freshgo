<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type'
    ];

    public function products()
    {
    	return $this->hasMany('App\Product', 'id', 'category_id');
    }
    
    public function subcategories() {
        return $this->hasMany('App\Category','parent_id');
    }
    public function parent() {
        return $this->belongsTo('App\Category','parent_id');
    }
}
