<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ownerFiles extends Model
{
    protected $table = 'ownerFiles';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'documentName' , 'title' , 'id_tfv_042119_owner'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
