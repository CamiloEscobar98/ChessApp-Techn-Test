<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Chess\ChessPiece;

class ChessPieceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pieces = ['king', 'rook', 'pawn', 'knight', 'queen', 'bishop'];

        foreach ($pieces as $piece) {
            ChessPiece::create(['name' => $piece]);
        }
    }
}
