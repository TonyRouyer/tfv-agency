<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rentalFiles extends Model
{
    protected $table = 'rentalFiles';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'documentName' , 'title' , 'id_tfv_042119_rental'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
