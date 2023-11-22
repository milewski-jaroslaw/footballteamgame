<?php

namespace Tests\Feature\Controllers\Api\Users;

use App\Models\User;
use Tests\TestCase;

class GetDataActionTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        // Disabling the cache before each test
        $this->refreshApplication();
    }

    public function test_user_data_action(): void
    {
        // Create a user
        $user = User::factory()->create();

        // Check the availability of the /user-data endpoint
        $getDataResponse = $this->actingAs($user, 'sanctum')->get('/api/user-data');

        // Check whether access to the endpoint is possible
        $getDataResponse->assertStatus(200);

        // Check whether the response contains the expected data or structure
        $getDataResponse->assertJson([
            'id' => $user->id,
            'username' => $user->username,
            'level' => 1,
            'level_points' => '0/100',
            'cards' => [],
            'new_card_allowed' => true,
        ]);
    }
}
