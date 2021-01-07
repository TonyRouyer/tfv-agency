<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class clientList extends Model
{
    protected $table = 'clientList';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'civility' , 
        'firstname' , 
        'lastname' ,
        'phone' ,
        'mail' ,
        'houseOrApartement' ,
        'buyOrRental' ,
        'city' ,
        'ray' ,
        'budget' ,
        'digicode' ,
        'balcony' ,
        'garden' ,
        'basement' ,
        'furniture' ,
        'elevator' ,
        'garage' ,
        'parking' ,
        'id_tfv042119_user' ,
        'id_tfv042119_status'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}

 