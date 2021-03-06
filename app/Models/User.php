<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;


use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable;

    protected $table = 'user';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lastname', 'firstname', 'mail' ,'avatar', 'rental', 'owner', 'rentalEntryDate', 'rentalBeginContractDate', 'rentalEndDate', 'id_tfv042119_role'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'id'
    ];


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     * Obtenez l'identifiant qui sera stocké dans la requête objet du JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     * Renvoie un tableau de valeurs de clé, contenant toutes les requête personnalisées à ajouter au JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}


