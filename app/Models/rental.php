<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rental extends Model
{
    protected $table = 'rental';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rentalPhone' , 'rentalMail' , 'rentalEntryDate' , 'rentalBeginContactDate' , 'rentalLastname' , 'rentalFirstname' , 'civility' , 'rentalEndDate'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
