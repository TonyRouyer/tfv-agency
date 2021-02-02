<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class alert extends Model
{
    protected $table = 'alert';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dateAlert',
        'zip',
        'city',
        'budgetMin',
        'budgetMax',
        'area',
        'houseApatment',
        'id_tfv042119_user'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}