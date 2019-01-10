<?php

namespace App;

use Jenssegers\Date\Date;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_read' => 'boolean'
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
        'fullname', 'object', 'message', 'email', 'is_read'
    ];

    /**
     * Retourne la date avec la method ->ago()
     * Attribut : created_at
     */
    public function getCreatedAtAttribute($value)
    {
        return Date::parse($value)->ago();
    }
}
