<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cart_id', 'product_id', 'quantity'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function cart()
    {
        return $this->belongsTo('App\Cart');
    }

    public function totalProduct()
    {
        return $this->product->price * $this->quantity;
    }
}
