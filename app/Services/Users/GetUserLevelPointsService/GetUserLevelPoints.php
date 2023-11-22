<?php

declare(strict_types=1);

namespace App\Services\Users\GetUserLevelPointsService;

final class GetUserLevelPoints
{
    protected int $numberOfPointsForWon;

    public function __construct()
    {
        $this->numberOfPointsForWon = config('game.settings.numberOfPointsForWon');
    }

    public function perform(int $winsCount): int
    {
        return $this->numberOfPointsForWon * $winsCount;

    }
}
