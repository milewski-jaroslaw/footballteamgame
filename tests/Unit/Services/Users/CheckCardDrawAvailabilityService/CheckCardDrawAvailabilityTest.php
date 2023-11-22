<?php

namespace Tests\Unit\Services\Users\CheckCardDrawAvailabilityService;

use App\Services\Cards\CheckCardDrawAvailabilityService\CheckCardDrawAvailability;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class CheckCardDrawAvailabilityTest extends TestCase
{
    public function test_check_card_draw_availability(): void
    {
        // Test preparation
        Config::set(['game.settings.numberOfCardsDrawnPerLevel' => 5]);
        $checkCardDrawAvailability = new CheckCardDrawAvailability();

        $this->assertTrue($checkCardDrawAvailability->perform(1, 4));
        $this->assertFalse($checkCardDrawAvailability->perform(1, 6));
        $this->assertTrue($checkCardDrawAvailability->perform(2, 7));
        $this->assertFalse($checkCardDrawAvailability->perform(2, 12));
        $this->assertTrue($checkCardDrawAvailability->perform(3, 4));
        $this->assertFalse($checkCardDrawAvailability->perform(3, 45));
    }
}
