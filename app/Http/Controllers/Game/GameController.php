<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Game\Game;

use App\Http\Resources\GameResource;

use function PHPUnit\Framework\isNull;

class GameController extends Controller
{
    /**
     * Attributes for the request.
     * 
     */
    protected $attributes = [];

    /**
     * Play the game.
     * 
     * @return Response
     */
    public function play($id, Request $request)
    {
        $game = Game::findOrFail($id);

        if ($game->game_state_id != 4) {
            if ($game->automatic_mode) {
                if (!isNull($game->gamingPlayer)) {
                    $maxNumber = $game->chessTable->dimensions;
                    $minNumber = $maxNumber * (-1);
                    $rules = [
                        'piece_one' => ['required', 'exists:chess_pieces,name'],
                        'piece_two' => ['required', 'exists:chess_pieces,name'],
                        'position_x_one' => ['different:position_x_two', 'numeric', 'min:' . $minNumber, 'max:' . $maxNumber],
                        'position_y_one' => ['different:position_y_two', 'numeric', 'min:' . $minNumber, 'max:' . $maxNumber],
                        'position_x_two' => ['different:position_x_one', 'numeric', 'min:' . $minNumber, 'max:' . $maxNumber],
                        'position_y_two' => ['different:position_y_one', 'numeric', 'min:' . $minNumber, 'max:' . $maxNumber]
                    ];
                    $this->validate($request, $rules, [], $this->attributes);

                    $pieceOne = $request->get('piece_one', 'knight');
                    $pieceTwo = $request->get('piece_two', 'knight');

                    $positionXOne = $request->get('position_x_one', 1);
                    $positionYOne = $request->get('position_y_one', 1);
                    $positionXTwo = $request->get('position_x_two', $maxNumber);
                    $positionYTwo = $request->get('position_y_two', $maxNumber);

                    $game->gamingPlayer->automaticPlaying($pieceOne, $pieceTwo, $positionXOne, $positionYOne, $positionXTwo, $positionYTwo);

                    return response()->json(['message' => 'The game has completed, the winner is: ' . $game->gamingPlayer->playerWinner->name]);
                }else{
                    return response()->json(['message' => 'Please, register the players to the game.']);
                }
            } else {
                $rules = [];
            }
        } else {
            return response()->json(['message' => 'The game already has been completed.']);
        }
    }

    /**
     * Get the information about Game
     * 
     * @return Response
     */
    public function info($id)
    {
        return new GameResource(Game::findOrFail($id));
    }
}
