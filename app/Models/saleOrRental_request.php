<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class saleOrRental_request extends Model
{
    protected $table = 'saleOrRental_request';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'saleOrRental',
        'houseApartment',
        'address',
        'zip',
        'city',
        'fullText',
        'mail',
        'phone',
        'id_tfv042119_status',
        'id_tfv042119_user'

    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
