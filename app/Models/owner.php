<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class owner extends Model
{
    protected $table = 'owner';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ownerLastname' , 'ownerFirstname' , 'ownerMail' , 'ownerPhone' , 'civility'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
