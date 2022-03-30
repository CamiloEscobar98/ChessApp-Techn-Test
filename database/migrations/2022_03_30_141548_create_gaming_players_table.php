<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gaming_players', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id')->unique('unique_gaming_players');
            $table->unsignedBigInteger('player_one_id');
            $table->unsignedBigInteger('player_two_id');
            $table->unsignedBigInteger('player_winner_id')->nullable();

            $table->foreign('game_id', 'fk_games_gaming_players')->references('id')->on('games')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('player_one_id', 'fk_players_one_gaming_players')->references('id')->on('players')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('player_two_id', 'fk_players_two_gaming_players')->references('id')->on('players')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('player_winner_id', 'fk_players_winner_gaming_players')->references('id')->on('players')->cascadeOnUpdate()->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gaming_players');
    }
};
