<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodOrderItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'item_id',
    ];

    public $timestamps = false;
}
