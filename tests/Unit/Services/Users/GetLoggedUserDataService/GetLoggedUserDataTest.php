<?php

namespace Tests\Unit\Services\Users\GetLoggedUserDataService;

use App\Models\User;
use App\Services\Users\GetLoggedUserDataService\GetLoggedUserData;
use App\Services\Users\GetLoggedUserDataService\GetLoggedUserDataOutput;
use Tests\TestCase;

class GetLoggedUserDataTest extends TestCase
{
    public function test_return_correct_user_data(): void
    {
        // Test preparation
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $loggedUserDataOutput  = new GetLoggedUserDataOutput();
        $loggedUserDataService = new GetLoggedUserData($loggedUserDataOutput);
        $loggedUserData = $loggedUserDataService->perform();

        $this->assertEquals($user->id, $loggedUserData->getId());
        $this->assertEquals($user->username, $loggedUserData->getUsername());
    }
}
