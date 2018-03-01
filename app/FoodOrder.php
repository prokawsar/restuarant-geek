<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodOrder extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'total_bill', 'order_date', 'status', 'cust_id', 'rest_id', 'table_id'
    ];

    public $timestamps = false;
}
