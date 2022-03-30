<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\GameState;

class GameStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gameStates = ['Created Recently', 'Suspended', 'Completed'];

        foreach ($gameStates as $gameState) {
            GameState::create(['name' => $gameState]);
        }
    }
}
