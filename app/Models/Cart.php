<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'coupon_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function getTotalAttribute()
    {
        return $this->items->sum('subtotal');
    }

    public function getDiscountedTotalAttribute()
    {
        $total = $this->total;
        if ($this->coupon) {
            if ($this->coupon->type === 'fixed') {
                return max(0, $total - $this->coupon->value);
            } else {
                return $total * (1 - $this->coupon->value / 100);
            }
        }
        return $total;
    }
}
