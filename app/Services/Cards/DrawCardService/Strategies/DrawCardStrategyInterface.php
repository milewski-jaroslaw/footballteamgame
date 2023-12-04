<?php

declare(strict_types=1);

namespace App\Services\Cards\DrawCardService\Strategies;

use App\Models\Card;

interface DrawCardStrategyInterface
{
    public function perform(): Card;
}
