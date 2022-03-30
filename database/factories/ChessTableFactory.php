<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Chess\ChessTable;

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
}
