<?php

declare(strict_types=1);

namespace App\Services\Cards\CheckCardDrawAvailabilityService;

final class CheckCardDrawAvailability
{
    private int $numberOfCardsDrawnPerLevel;

    public function __construct()
    {
        $this->numberOfCardsDrawnPerLevel = config('game.settings.numberOfCardsDrawnPerLevel');
    }

    public function perform(int $userLevel, int $numberOfCardsDrawnByUser): bool
    {
        $userCanDrawnCardsCount = $userLevel * $this->numberOfCardsDrawnPerLevel;

        return $userCanDrawnCardsCount > $numberOfCardsDrawnByUser;
    }
}
