<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Game\GameState;

class GameStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gameStates = ['Created Recently', 'In Game', 'Suspended', 'Completed'];

        foreach ($gameStates as $gameState) {
            GameState::create(['name' => $gameState]);
        }
    }
}
