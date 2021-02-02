<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class managementProposal extends model
{
    protected $table = 'management_Proposal';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type' , 
        'address' , 
        'zip' , 
        'city' , 
        'fullText', 
        'id_tfv_042119_user' ,
        'id_tfv042119_user_owner_have_management_proposal' ,
        'id_tfv042119_user_rental_have_management_proposal'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
