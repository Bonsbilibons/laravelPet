<?php

namespace App\Services;

use App\Repositories\IpBlacklistRepository;

class BlacklistService
{
   private $ipBlacklistRepository;

    /**
     * @param $ipBlacklistRepository
     */
    public function __construct(IpBlacklistRepository $ipBlacklistRepository)
    {
        $this->ipBlacklistRepository = $ipBlacklistRepository;
    }

    public function isIpInBlacklist($ip)
    {
        return $this->ipBlacklistRepository->isIpInBlacklist($ip);
    }

}
