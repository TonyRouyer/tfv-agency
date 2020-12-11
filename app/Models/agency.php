<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class agency extends Model
{
    protected $table = 'agency';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name' , 'address' , 'city' , 'zip'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
