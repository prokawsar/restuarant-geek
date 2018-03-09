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

    protected $dates = ['order_date'];

    public function item()
    {
        return $this->belongsToMany('App\Item','food_order_items','order_id','item_id')->withPivot('id', 'item_quantity', 'order_status');
    }

    public function table()
    {
        return $this->belongsTo('App\Table');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'cust_id');
    }

}
