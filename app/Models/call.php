<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class call extends Model
{
    protected $table = 'call';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lastname' ,
        'firstname' , 
        'mail' ,
        'availability' ,
        'preferenceCall' ,
        'phone' ,
        'id_tfv042119_status' 
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}

 