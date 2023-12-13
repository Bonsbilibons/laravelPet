<?php

namespace App\Repositories;

use App\Models\IpBlacklist;

class IpBlacklistRepository
{
    public function addIp($ip)
    {
        IpBlacklist::query()->create($ip);
    }

    public function isIpInBlacklist($ip)
    {
        if(IpBlacklist::query()->where('ip', $ip)->exists())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
