<?php

declare(strict_types=1);

namespace Tests\Unit\Services\Cards\DrawCardService;

use App\Repositories\CardRepository;
use PHPUnit\Framework\TestCase;
use App\Services\Cards\DrawCardService\DrawCardStrategyFactory;
use App\Services\Cards\DrawCardService\Strategies\DrawCardStrategyInterface;
use App\Services\Cards\DrawCardService\Strategies\DrawRandomCardStrategy;

class DrawCardStrategyFactoryTest extends TestCase
{
    public function testGetDrawRandomCardStrategyInstance(): void
    {
        $cardRepository         = new CardRepository();
        $drawRandomCardStrategy = new DrawRandomCardStrategy($cardRepository);
        $factory                = new DrawCardStrategyFactory($drawRandomCardStrategy);

        $strategy = $factory->getStrategy();

        $this->assertInstanceOf(DrawCardStrategyInterface::class, $strategy);
    }
}
