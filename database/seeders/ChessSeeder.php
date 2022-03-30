<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ChessTable;

class ChessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chessTables = ChessTable::factory()->count(2)->create();

        foreach ($chessTables as $chessTable) {
            $contX = 1;

            while ($contX <= $chessTable->dimensions) {
                $contY = 1;
                while ($contY <= $chessTable->dimensions) {
                    $chessTable->chessSquares()->create(['position_x' => $contX, 'position_y' => $contY]);
                    $contY++;
                }
                $contX++;
            }
        }
    }
}
