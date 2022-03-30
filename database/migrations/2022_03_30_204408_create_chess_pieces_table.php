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
        Schema::create('chess_pieces', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name')->unique('unique_name_chess_pieces');
            $table->string('slug')->unique('unique_slug_chess_pieces');
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
        Schema::dropIfExists('chess_pieces');
    }
};
