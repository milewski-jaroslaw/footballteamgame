<?php

namespace App\Http\Controllers\Api\Duels;

use App\Http\Controllers\Controller;

class GetHistoryAction extends Controller
{
    public function __invoke()
    {
        return response()->json([
            [
                "id" => 1,
                "player_name" => "Jan Kowalski",
                "opponent_name" => "Piotr Nowak",
                "won" => 0
            ],
            [
                "id" => 2,
                "player_name" => "Jan Kowalski",
                "opponent_name" => "Tomasz Kaczyński",
                "won" => 1
            ],
            [
                "id" => 3,
                "player_name" => "Jan Kowalski",
                "opponent_name" => "Agnieszka Tomczak",
                "won" => 1
            ],
            [
                "id" => 4,
                "player_name" => "Jan Kowalski",
                "opponent_name" => "Michał Bladowski",
                "won" => 1
            ],
        ]);
    }
}
