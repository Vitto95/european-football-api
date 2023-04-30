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
        Schema::create('football_matches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('home_team_id');
            $table->unsignedBigInteger('away_team_id');
            $table->dateTime('starts_at');
            $table->dateTime('ends_at');
            $table->integer('home_team_score')->nullable();
            $table->integer('away_team_score')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('home_team_id')->references('id')->on('football_teams');
            $table->foreign('away_team_id')->references('id')->on('football_teams');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('football_matches');
    }
};
