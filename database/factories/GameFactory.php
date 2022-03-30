<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Game;
use App\Models\GameState;
use App\Models\ChessTable;

class GameFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Game::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'game_state_id' => 1,
            'chess_table_id' => ChessTable::all()->random(1)->first()->id,
            'name' => "New Game " . $this->faker->word,
        ];
    }
}
