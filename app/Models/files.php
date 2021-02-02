<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class files extends Model
{
    protected $table = 'files';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'documentName' , 'title' , 'id_tfv_042119_user', 'id_tfv042119_management_proposal'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
