<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_or_no', 'rest_id'
    ];

    public $timestamps = false;
}
