<?php

namespace Tests\Unit\Services\Users\GetUserLevelService;

use App\Services\Users\GetUserLevelService\GetUserLevel;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class GetUserLevelTest extends TestCase
{
    public function test_perform_returns_correct_user_level(): void
    {
        // Test preparation
        $pointLevels = [
            0 => 1,
            100 => 2,
            160 => 3,
        ];

        Config::set(['game.user-level-points' => $pointLevels]);
        $getUserLevel = new GetUserLevel();

        // Test for various points
        $result0 = $getUserLevel->perform(0);
        $this->assertEquals(1, $result0);

        $result1 = $getUserLevel->perform(50);
        $this->assertEquals(1, $result1);

        $result2 = $getUserLevel->perform(150);
        $this->assertEquals(2, $result2);

        $result3 = $getUserLevel->perform(250);
        $this->assertEquals(3, $result3);
    }
}
