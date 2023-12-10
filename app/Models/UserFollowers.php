<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFollowers extends Model
{
    protected $table = 'user_followers';
    public $timestamps = true;
    protected $fillable = [
        'author_id',
        'follower_id'
    ];
}
