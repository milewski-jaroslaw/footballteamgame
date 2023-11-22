<?php

declare(strict_types=1);

namespace App\Services\Users\GetUserLevelService;

final class GetUserLevel
{
    private array $pointLevels;

    public function __construct()
    {
        $this->pointLevels = config('game.user-level-points');
    }

    public function perform(int $points): int
    {
        foreach (array_reverse($this->pointLevels, true) as $key => $value) {
            if ($points >= $key) {
                return $value;
            }
        }

        return 1;
    }
}
