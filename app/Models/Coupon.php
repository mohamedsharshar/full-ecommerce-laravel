<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupons';
    protected $guarded = [];
    protected $casts = ['expires_at' => 'datetime'];

    public function isValid($total)
    {
        if ($this->expires_at && Carbon::now()->gt($this->expires_at)) {
            return false;
        }

        if ($total < $this->min_order_amount) {
            return false;
        }

        return true;
    }

    public function discount($total)
    {
        if ($this->type === 'fixed') {
            return min($this->value, $total);
        }

        if ($this->type === 'percent') {
            return ($this->value / 100) * $total;
        }

        return 0;
    }
}
