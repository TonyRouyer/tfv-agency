<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class apartment extends realEstate
{
    protected $table = 'real_estate';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'elevator' , 'digicode'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
