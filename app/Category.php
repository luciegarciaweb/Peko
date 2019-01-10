<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'name'
    ];

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
     * Récupère les varietés des catégories
     */
    public function varieties()
    {
        return $this->hasMany('App\Variety');
    }

    /**
     * Récupère les produits d'une catégorie
     */
    public function products()
    {
        return $this->hasManyThrough(
            'App\Product',
            'App\Variety',
            'category_id', 
            'variety_id',
            'id',
            'id'
        );
    }  
    
    /**
     * Retourne la catégorie selectionné
     *
     * @return string
     */
    public function selectedCategory($category_id)
    {
        if ($this->id === $category_id) {
            return "selected";
        }
    }
}
