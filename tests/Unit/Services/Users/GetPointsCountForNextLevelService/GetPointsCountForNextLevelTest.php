<?php

namespace Tests\Unit\Services\Users\GetPointsCountForNextLevelService;

use App\Services\Users\GetPointsCountForNextLevelService\GetPointsCountForNextLevel;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class GetPointsCountForNextLevelTest extends TestCase
{
    public function test_perform_returns_correct_next_level_points_count(): void
    {
        // Test preparation
        $pointLevels = [
            0 => 1,
            100 => 2,
            160 => 3,
        ];

        Config::set(['game.user-level-points' => $pointLevels]);
        $getUserLevel = new GetPointsCountForNextLevel();

        // Test for various points
        $result0 = $getUserLevel->perform(0);
        $this->assertEquals(100, $result0);

        $result1 = $getUserLevel->perform(20);
        $this->assertEquals(100, $result1);

        $result2 = $getUserLevel->perform(100);
        $this->assertEquals(160, $result2);

        $result3 = $getUserLevel->perform(250);
        $this->assertEquals(0, $result3);
    }
}
