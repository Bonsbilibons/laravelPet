<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IpBlacklist extends Model
{
    protected $table = 'ip_blacklist';
    public $timestamps = true;

    protected $fillable = [
        'ip',
    ];
}
