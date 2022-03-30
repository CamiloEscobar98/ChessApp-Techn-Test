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
        $pieces = [
            [
                'name' => 'king',
                'movements' => []
            ],
            [
                'name' => 'rook',
                'movements' => []
            ],
            [
                'name' => 'pawn',
                'movements' => []
            ],
            [
                'name' => 'knight',
                'movements' => [
                    [
                        'movement_x' => 1,
                        'movement_y' => 2,
                    ],
                    [
                        'movement_x' => 2,
                        'movement_y' => 1,
                    ],
                    [
                        'movement_x' => 2,
                        'movement_y' => -1,
                    ],
                    [
                        'movement_x' => 1,
                        'movement_y' => -2,
                    ],
                    [
                        'movement_x' => -1,
                        'movement_y' => -2,
                    ],
                    [
                        'movement_x' => -2,
                        'movement_y' => -1,
                    ],
                    [
                        'movement_x' => -2,
                        'movement_y' => 1,
                    ],
                    [
                        'movement_x' => -1,
                        'movement_y' => 2,
                    ],
                ]
            ],
            [
                'name' => 'queen',
                'movements' => []
            ],
            [
                'name' => 'bishop',
                'movements' => []
            ],
        ];

        foreach ($pieces as $piece) {
            $chessPiece = ChessPiece::create(['name' => $piece['name']]);
            $movements = $piece['movements'];
            if (!empty($movements)) {
                foreach ($movements as $movement) {
                    $chessPiece->movements()->create([
                        'movement_x' => $movement['movement_x'], 'movement_y' => $movement['movement_y']
                    ]);
                }
            }
        }
    }
}
