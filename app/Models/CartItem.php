<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['cart_id', 'product_id', 'quantity', 'unit_price', 'subtotal'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($cartItem) {
            $cartItem->unit_price = $cartItem->product->price;
            $cartItem->subtotal = $cartItem->unit_price * $cartItem->quantity;
        });

        static::updating(function ($cartItem) {
            $cartItem->subtotal = $cartItem->unit_price * $cartItem->quantity;
        });
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
