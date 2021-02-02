<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class images extends Model
{
    protected $table = 'images';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title' , 'image' , 'id_tfv042119_real_estate'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
