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
        Schema::create('chess_squares', function (Blueprint $table) {
       
            $table->id();
            $table->unsignedBigInteger('chess_table_id');
            $table->unsignedTinyInteger('position_x');
            $table->unsignedTinyInteger('position_y');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chess_squares');
    }
};
