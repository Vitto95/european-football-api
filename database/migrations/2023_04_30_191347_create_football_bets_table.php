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
        Schema::create('football_bets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('football_match_id');
            $table->integer('home_team_bet_score');
            $table->integer('away_team_bet_score');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('football_match_id')->references('id')->on('football_matches');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('football_bets');
    }
};
