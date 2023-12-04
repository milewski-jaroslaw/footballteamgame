<?php

declare(strict_types=1);

namespace App\Services\Cards\DrawCardService\Strategies;

use App\Models\Card;
use App\Repositories\CardRepository;

class DrawRandomCardStrategy implements DrawCardStrategyInterface
{
    public function __construct(private readonly CardRepository $cardRepository)
    {
    }

    public function perform(): Card
    {
        /**
         * @var Card
         */
        return $this->cardRepository
            ->getRandom()
            ->take(1)
            ->first();
    }
}
