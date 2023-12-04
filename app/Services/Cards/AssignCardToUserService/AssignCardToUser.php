<?php

declare(strict_types=1);

namespace App\Services\Cards\AssignCardToUserService;

use App\Models\Card;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AssignCardToUser
{
    public function perform(Card $card, User $user, int $userLevel = 0): void
    {
        DB::transaction(static function () use ($userLevel, $card, $user) {
            $user->cards()->attach($card->getKey(), [
                'was_drawn' => (bool)$userLevel,
                'drawn_level' => $userLevel,
                'created_at' => now(),
            ]);
        });
    }
}
