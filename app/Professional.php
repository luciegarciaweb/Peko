<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    protected $primaryKey = 'user_id';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_accepted' => 'boolean',
        'is_requested' => 'boolean',
        'is_denied' => 'boolean'
    ];

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
        'social_reason', 
        'company_name', 
        'siret',
        'tva_intracommunity',
        'is_accepted',
        'is_requested',
        'is_denied'
    ];
}
