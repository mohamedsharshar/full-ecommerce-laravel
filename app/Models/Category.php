<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model implements HasMedia
{
    use InteractsWithMedia,SoftDeletes;
    protected $table = 'categories';
    protected $guarded = [];

    public function getPictureUrlAttribute()
    {
        return $this->getMedia();
    }
    public function parent()
    {
        return $this->belongsToOne(Category::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
