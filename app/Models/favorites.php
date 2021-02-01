<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class favorites extends Model
{
    protected $table = 'favorites';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_tfv042119_user',
        'id_tfv042119_real_estate',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}