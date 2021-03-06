<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone',
    ];

    public function review(){

        return $this->hasMany('App\Review');

    }

    public function foodOrder(){

        return $this->hasMany('App\FoodOrder');

    }
}
