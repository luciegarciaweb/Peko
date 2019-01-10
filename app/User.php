<?php

namespace App;

use Jenssegers\Date\Date;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
        'is_admin' => 'boolean'
    ];
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 
        'lastname', 
        'email', 
        'password', 
        'is_active', 
        'phone', 
        'address', 
        'complement', 
        'postal_code', 
        'city',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Retourne la date avec la method ->ago()
     * Attribut : created_at
     */
    public function getCreatedAtAttribute($value)
    {
        return Date::parse($value)->ago();
    }

    /**
     * Récupère les commandes de l'utilisateur
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function pro()
    {
        return $this->hasOne('App\Professional');
    }

    public function carts()
    {
        return $this->hasMany('App\Cart');
    }

    /**
     * Affiche le prénom et le nom de famille
     */
    public function fullname()
    {
        return "{$this->firstname} {$this->lastname}";
    }
}
