<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $table = "reviews";
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
