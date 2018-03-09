<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'review', 'review_date', 'discount_amount', 'cust_id', 'rest_id',
    ];

    public $timestamps = false;
    protected $dates = ['review_date'];

    public function customer(){

        return $this->belongsTo('App\Customer','cust_id');

    }
}
