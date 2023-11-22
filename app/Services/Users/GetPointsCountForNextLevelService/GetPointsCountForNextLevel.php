<?php

declare(strict_types=1);

namespace App\Services\Users\GetPointsCountForNextLevelService;

final class GetPointsCountForNextLevel
{
    private array $pointLevels;

    public function __construct()
    {
        $this->pointLevels = config('game.user-level-points');
    }

    public function perform(int $points): int
    {
        $nextLevelPoints = array_filter(array_keys($this->pointLevels), static fn($key) => $key > $points);

        return empty($nextLevelPoints) ? 0 : min($nextLevelPoints);
    }
}
