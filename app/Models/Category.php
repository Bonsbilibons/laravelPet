<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Category extends Model
{
    protected $table = 'categories';
    public $timestamps = true;
    protected $fillable = [
        'title',
    ];

    public function posts()
    {
        return $this->hasManyThrough(
            Post::class,
            PostCategory::class,
            'category_id', // Foreign key on the cars table...
            'id', // Foreign key on the owners table...
            'id', // Local key on the mechanics table...
            'post_id' // Local key on the cars table...
        );
    }
}
