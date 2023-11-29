<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostComments extends Model
{
    protected $table = 'post_comments';
    public $timestamps = true;

    protected $fillable = [
        'post_id',
        'user_id',
        'comment'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
