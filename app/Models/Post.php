<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status'
    ];

    protected $guarded = [
        'id'
    ];

    public function category()
    {
        return $this->hasOneThrough(
            Category::class,
            PostCategory::class,
            'post_id', // Foreign key on the cars table...
            'id', // Foreign key on the owners table...
            'id', // Local key on the mechanics table...
            'category_id' // Local key on the cars table...
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function postCategory()
    {
        return $this->hasOne(PostCategory::class, 'post_id');
    }

    public function comments()
    {
        return $this->hasMany(PostComments::class, 'post_id');
    }

    public function images()
    {
        return $this->hasMany(PostImages::class, 'post_id');
    }

    public function likes()
    {
        return $this->hasMany(PostLikes::class, 'post_id');
    }
}
