<?php

declare(strict_types=1);

namespace App\Services;

use Closure;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

final class CacheService
{
    public function perform(string $cacheKey, int $cacheHours, Closure $callback)
    {
        $userLevel = Cache::get($cacheKey);

        if (null === $userLevel) {
            $userLevel = $callback();
            Cache::put($cacheKey, $userLevel, $this->getCacheTime($cacheHours));
        }

        return $userLevel;
    }

    private function getCacheTime(int $cacheHours): Carbon
    {
        return now()->addHours($cacheHours);
    }
}
