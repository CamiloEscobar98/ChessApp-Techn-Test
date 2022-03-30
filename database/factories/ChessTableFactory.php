<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\ChessTable;

class ChessTableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ChessTable::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $dimensions = $this->faker->unique()->numberBetween(6, 9) * 2;
        return [
            'name' => "ChessTable " . $dimensions . "x" . $dimensions,
            'dimensions' => $dimensions,
        ];
    }

    /**
     * Define the model's configuration.
     *
     * @return void
     */
    public function configure()
    {
        return $this->afterCreating(function ($chessTable) {
            $contX = 1;
            while ($contX <= $chessTable->dimensions) {
                $contY = 1;
                while ($contY <= $chessTable->dimensions) {
                    $chessTable->chessSquares()->create(['position_x' => $contX, 'position_y' => $contY]);
                    $contY++;
                }
                $contX++;
            }
        });
    }
}
