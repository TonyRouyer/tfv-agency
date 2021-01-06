<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class managementProposal extends model
{
    protected $table = 'managementProposal';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type' , 'address' , 'zip' , 'city' , 'fullText', 'id_tfv_042119_user'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
