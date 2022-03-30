<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ChessSeeder::class,
            ChessPieceSeeder::class,
            PlayerSeeder::class,
            GameStateSeeder::class,
            GameSeeder::class
        ]);
    }
}
