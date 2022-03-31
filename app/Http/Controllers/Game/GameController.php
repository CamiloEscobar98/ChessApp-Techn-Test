<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

use App\Models\Game\Game;

class GameController extends Controller
{
    /**
     * Attributes for the request.
     * 
     */
    protected $attributs = [];

    /**
     * Play the game.
     * 
     * @return Response
     */
    public function play($id)
    {
        $game = Game::findOrFail($id);

        dd($game->gamingPlayer());
    }
}
