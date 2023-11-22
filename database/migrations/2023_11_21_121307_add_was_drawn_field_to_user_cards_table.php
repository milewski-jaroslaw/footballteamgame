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
        Schema::table('user_cards', static function (Blueprint $table) {
            $table->boolean('was_drawn')->default(false);
            $table->integer('drawn_level')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_cards', static function (Blueprint $table) {
            $table->dropColumn(['was_drawn', 'drawn_level']);
        });
    }
};
