<?php

namespace App;

use Jenssegers\Date\Date;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
        'push_forward' => 'boolean',
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
        'variety_id', 'container_id', 'title', 'quantity',
        'slug', 'price', 'body', 'picture', 'price_kilo', 'weight_unity', 'is_active', 'push_forward'
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
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Récupère le filtre du prix
     */
    public function container()
    {
        return $this->belongsTo('App\Container');
    }

    /**
     * Récupère la variété
     */
    public function variety()
    {
        return $this->belongsTo('App\Variety');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Retourne le contenant selectionné 
     * 
     * @return string
     */
    public function selectedContainer($container_id)
    {
        if ($this->container_id === $container_id) {
            return "selected";
        }
    }

    /**
     * Retourne la variété selectionné
     *
     * @return string
     */
    public function selectedVariety($variety_id)
    {
        if ($this->variety_id === $variety_id) {
            return "selected";
        }
    }
}
