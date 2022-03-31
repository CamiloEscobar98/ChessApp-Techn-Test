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
        Schema::create('player_movements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gaming_player_id');
            $table->unsignedBigInteger('player_id');
            $table->unsignedTinyInteger('chess_piece_id');
            
            $table->tinyInteger('position_x');
            $table->tinyInteger('position_y');

            $table->timestamps();

            $table->foreign('gaming_player_id', 'fk_gaming_player_player_movements')->references('id')->on('gaming_players')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('player_id', 'fk_players_player_movements')->references('id')->on('players')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('chess_piece_id', 'fk_chess_pieces_player_movements')->references('id')->on('chess_pieces')->cascadeOnUpdate()->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('player_movements');
    }
};
