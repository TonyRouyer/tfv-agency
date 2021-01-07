<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class dataPrice extends Model
{
    protected $table = 'dataPrice';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'STATUT' , 
        'INSEE_COM' , 
        'NOM_COM' ,
        'INSEE_ARR' ,
        'NOM_DEP' ,
        'INSEE_DEP' ,
        'NOM_REG' ,
        'INSEE_REG' ,
        'CODE_EPCI' ,
        'NOM_COM_M' ,
        'Prixm2' ,
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
