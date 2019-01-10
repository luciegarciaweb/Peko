<?php

namespace App;

use Jenssegers\Date\Date;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'variety_id', 'recipe', 'picture', 'name', 'body'
    ];

    public function variety()
    {
        return $this->belongsTo('App\Variety');
    }
    
    public function selectedVariety($variety_id)
    {
        if ($this->variety_id === $variety_id) {
            return "selected";
        }
    }
    
    public function product()
    {
        return $this->hasOne('App\Product');
    }

    /**
     * Retourne la date avec la method ->ago()
     * Attribut : created_at
     */
    public function getCreatedAtAttribute($value)
    {
        return Date::parse($value)->ago();
    }    
}
