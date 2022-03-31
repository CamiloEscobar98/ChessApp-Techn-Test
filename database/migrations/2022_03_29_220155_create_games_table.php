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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chess_table_id');
            $table->unsignedTinyInteger('game_state_id')->nullable();
            $table->string('name')->unique('unique_games');
            $table->boolean('automatic_mode')->default(true);

            $table->foreign('game_state_id', 'fk_games_states_games')->references('id')->on('game_states')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('chess_table_id', 'fk_chess_tables_games')->references('id')->on('chess_tables')->cascadeOnUpdate()->restrictOnDelete();
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
        Schema::dropIfExists('games');
    }
};
