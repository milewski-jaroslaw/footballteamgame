<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

final class UserRepository
{
    public function getById(int $id): Builder
    {
        return $this->query()
            ->where('id', $id);
    }

    private function query(): Builder
    {
        return User::query();
    }
}
