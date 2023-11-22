<?php

namespace Tests\Unit\Services\Users\GetUserLevelPointsService;

use App\Services\Users\GetUserLevelPointsService\GetUserLevelPoints;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class GetUserLevelPointsTest extends TestCase
{
    public function test_perform_returns_correct_user_level(): void
    {
        // Test preparation
        Config::set(['game.settings.numberOfPointsForWon' => 20]);
        $getUserLevelPoints = new GetUserLevelPoints();

        // Test for various points
        $result0 = $getUserLevelPoints->perform(0);
        $this->assertEquals(0, $result0);

        $result1 = $getUserLevelPoints->perform(1);
        $this->assertEquals(20, $result1);

        $result2 = $getUserLevelPoints->perform(2);
        $this->assertEquals(40, $result2);

        $result3 = $getUserLevelPoints->perform(5);
        $this->assertEquals(100, $result3);
    }
}
