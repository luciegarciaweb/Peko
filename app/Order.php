<?php

namespace App;

use Jenssegers\Date\Date;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_completed' => 'boolean',
        'is_paid' => 'boolean',
        'in_progress' => 'boolean',
        'is_ready' => 'boolean',
        'is_canceled' => 'boolean'
    ];
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'retrieval_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_paid', 
        'is_completed', 
        'is_ready', 
        'in_progress', 
        'is_canceled',
        'price', 
        'user_id', 
        'retrieval_at'
    ];

    public function getRetrievalAtAttribute($value)
    {
        $date = Date::parse($value);
        return Date::create($date->year, $date->day, $date->month)->format('l j F Y'). ' à '. $date->hour . ' heure';
    }
    
    /**
     * Retourne la date avec la method ->ago()
     * Attribut : created_at
     */
    public function getCreatedAtAttribute($value)
    {
        return Date::parse($value)->ago();
    }

    /**
     * Récupère l'utilisateur du produit
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product', 'order_products')
            ->withPivot('quantity');
    }

    public function scopeCurrent($query)
    {
        return $query->where('is_completed', false)->where('is_canceled', false);
    }

    public function scopeHistory($query)
    {
        return $query->where('is_completed', true)->orWhere('is_canceled', true);
    }

    public function status()
    {
        if ($this->is_canceled) {
            return '<span class="badge badge-danger">Annuler</span>';
        } elseif ($this->is_completed) {
            return '<span class="badge badge-success">Terminé</span>';
        } elseif ($this->is_ready) {
            return '<span class="badge badge-primary">Prête</span>';
        } elseif ($this->in_progress) {
            return '<span class="badge badge-warning">En préparation</span>';
        } elseif ($this->is_paid) {
            return '<span class="badge badge-info">Payer</span>';
        }
    } 
}
