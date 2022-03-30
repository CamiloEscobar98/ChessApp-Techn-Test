<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Game\Game;
use App\Models\Chess\ChessTable;
use App\Models\Player;

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

    /**
     * Define the model's configuration.
     *
     * @return void
     */
    public function configure()
    {
        return $this->afterCreating(function ($game) {
            $boolean = (bool) rand(0, 1);

            if ($boolean) {
                $players = Player::all()->random(2);
                $game->update(['game_state_id' => 2]);
                $game->gamingPlayer()->create(['player_one_id' => $players[0]->id, 'player_two_id' => $players[1]->id]);
            }
        });
    }
}
