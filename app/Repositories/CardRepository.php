<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Card;
use Illuminate\Database\Eloquent\Builder;

final class CardRepository
{
    public function getAllByUserId(int $userId): Builder
    {
        return $this->query()
            ->whereHas('users', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            });
    }

    public function getAllDrawnByUserId(int $userId): Builder
    {
        return $this->getAllByUserId($userId)
            ->whereHas('drawn', function ($query) {
                $query->where('was_drawn', true);
            });
    }

    public function getRandom(): Builder
    {
        return $this->query()->inRandomOrder();
    }

    private function query(): Builder
    {
        return Card::query();
    }
}
