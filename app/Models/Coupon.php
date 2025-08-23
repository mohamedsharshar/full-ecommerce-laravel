<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupons';
    protected $guarded = [];
    protected $casts = ['expires_at' => 'datetime'];

    public function isValid($total)
    {
        return (!$this->expires_at || $this->expires_at->isFuture()) &&
            $total >= $this->min_order_amount;
    }
}
