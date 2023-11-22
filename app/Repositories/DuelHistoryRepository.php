<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\DuelHistory;
use Illuminate\Database\Eloquent\Builder;

final class DuelHistoryRepository
{
    public function getUserWins(int $userId): Builder
    {
        return $this->query()
            ->where(function ($query) use ($userId) {
                $query->where('player_id', $userId)
                    ->where('won', true);
            })
            ->orWhere(function ($query) use ($userId) {
                $query->where('opponent_id', $userId)
                    ->where('won', false);
            });
    }

    private function query(): Builder
    {
        return DuelHistory::query();
    }
}
