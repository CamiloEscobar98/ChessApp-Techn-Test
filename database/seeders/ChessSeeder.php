<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Chess\ChessTable;

class ChessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ChessTable::factory()->count(2)->create();
    }
}
