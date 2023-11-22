<?php

namespace Database\Seeders;

use App\Models\DuelHistory;
use Illuminate\Database\Seeder;

class DuelHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DuelHistory::factory()->createMany(10);
    }
}
