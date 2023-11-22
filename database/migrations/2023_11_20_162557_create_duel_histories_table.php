<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('duel_histories', static function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('player_id')->index();
            $table->integer('opponent_id')->index();
            $table->boolean('won');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('duel_histories');
    }
};
