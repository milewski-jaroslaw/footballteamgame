<?php

declare(strict_types=1);

namespace App\Services\Cards\DrawCardService;

use App\Services\Cards\DrawCardService\Strategies\DrawCardStrategyInterface;
use App\Services\Cards\DrawCardService\Strategies\DrawRandomCardStrategy;

class DrawCardStrategyFactory
{
    public function __construct(private readonly DrawRandomCardStrategy $drawRandomCardStrategy)
    {
    }

    public function getStrategy(): DrawCardStrategyInterface
    {
        return $this->drawRandomCardStrategy;
    }
}
