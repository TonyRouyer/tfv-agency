<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class estimate extends Model
{
    protected $table = 'estimate';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'price' , 'address' , 'zip', 'city', 'area'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
