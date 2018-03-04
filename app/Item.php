<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_name', 'price', 'rest_id', 'cat_id'
    ];


    public function order()
    {
        return $this->belongsToMany('App\FoodOrder','food_order_items','item_id','order_id');
    }
}
