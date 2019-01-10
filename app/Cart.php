<?php

namespace App;

use Jenssegers\Date\Date;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'session',
        'is_completed',
        'retrieval_at',
        'key',
        'price'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'retrieval_at'
    ];

    public function getRetrievalAtAttribute($value)
    {
        $date = Date::parse($value);
        return Date::create($date->year, $date->day, $date->month)->format('l j F Y'). ' à '. $date->hour . ' heures';
    }

    public function carts()
    {
        return $this->hasMany('App\CartProduct');
    }
}
