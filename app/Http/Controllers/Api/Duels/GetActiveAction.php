<?php

namespace App\Http\Controllers\Api\Duels;

use App\Http\Controllers\Controller;

class GetActiveAction extends Controller
{
    public function __invoke(): string
    {
        return response()->json([
            'round' => 4,
            'your_points' => 260,
            'opponent_points' => 100,
            'status' => 'active',
            'cards' => config('game.cards'),
        ]);
    }
}
