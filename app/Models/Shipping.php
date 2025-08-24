<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Shipping extends Model
{
    use HasTranslations;

    protected $table = 'shippings';
    protected $guarded = [];

    public $translatable = ['name','address','city', 'state'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
