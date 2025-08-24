<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Review extends Model
{
    use HasFactory,SoftDeletes,HasTranslations;

    public $translatable=['user_name','comment'];
    protected $table = "reviews";
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
