<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Relations\Pivot;

use App\Models\Player;
use App\Models\Chess\ChessTable;
use App\Models\Chess\ChessPiece;
use App\Models\PlayerMovement;
use Illuminate\Database\QueryException;

class GamingPlayer extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gaming_players';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['game_id', 'player_one_id', 'player_two_id', 'player_winner_id'];

    /**
     * Get the Game which is relationed with GamingPlayer.
     * 
     * @return Game $game
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * Get the Player 1 which is relationed with GamingPlayer.
     * 
     * @return Player $playerOne
     */
    public function playerOne()
    {
        return $this->belongsTo(Player::class, 'player_one_id');
    }

    /**
     * Get the Player 2 which is relationed with GamingPlayer.
     * 
     * @return Player $playerTwo
     */
    public function playerTwo()
    {
        return $this->belongsTo(Player::class, 'player_two_id');
    }

    /**
     * Get the Player WINNER which is relationed with GamingPlayer.
     * 
     * @return Player $playerWinner
     */
    public function playerWinner()
    {
        return $this->belongsTo(Player::class, 'player_winner_id');
    }

    /**
     * Get the ChessTable which is relationed with GamingPlayer.
     * 
     * @return ChessTable $chessTable
     */
    public function chessTable()
    {
        return $this->belongsToMany(ChessTable::class, null, 'chess_table_id');
    }

    /**
     * Get the PlayerMovements which are relationed with PlayerMovement.
     * 
     * @return PlayerMovement $playerMovements
     */
    public function playerMovements()
    {
        return $this->hasMany(PlayerMovement::class, 'gaming_player_id');
    }

    public function automaticPlaying($pieceOne, $pieceTwo, $positionXOne, $positionYOne, $positionXTwo, $positionYTwo)
    {
        $pieceOne = ChessPiece::where('name', $pieceOne)->get()->first();
        $pieceTwo = ChessPiece::where('name', $pieceTwo)->get()->first();

        $playerOne = $this->playerOne->id;
        $playerTwo = $this->playerTwo->id;

        $dimensions = $this->game->chessTable->dimensions;

        try {
            if ($this->playerMovements()->count() == 0) {
                $this->createPlayerMovement($pieceOne->id, $playerOne, $positionXOne, $positionYOne);
                $this->createPlayerMovement($pieceTwo->id, $playerTwo, $positionXTwo, $positionYTwo);
            }

            $avaliableMovementsPlayerOne = $pieceOne->avaliableMovements($positionXOne, $positionYOne, $dimensions);
            $randomAvaliableMovementPlayerOne = $avaliableMovementsPlayerOne->random(1)->first();

            $avaliableMovementsPlayerTwo = $pieceOne->avaliableMovements($positionXTwo, $positionYTwo, $dimensions);

            $randomAvaliableMovementPlayerTwo = $avaliableMovementsPlayerTwo->random(1)->first();


            $firstMovePlayerOne = $this->createPlayerMovement(
                $pieceOne->id,
                $playerOne,
                $positionXOne + $randomAvaliableMovementPlayerOne->movement_x,
                $positionYOne + $randomAvaliableMovementPlayerOne->movement_y
            );
            $firstMovePlayerTwo = $this->createPlayerMovement(
                $pieceTwo->id,
                $playerTwo,
                $positionXTwo + $randomAvaliableMovementPlayerTwo->movement_x,
                $positionYTwo + $randomAvaliableMovementPlayerTwo->movement_y
            );

            $cont = 0;

            while ($firstMovePlayerOne->position_converted !=  $firstMovePlayerTwo->position_converted) {
                try {
                    $avaliableMovementsPlayerOne = $pieceOne->avaliableMovements($firstMovePlayerOne->position_x, $firstMovePlayerOne->position_y, $dimensions);
                    $randomAvaliableMovementPlayerOne = $avaliableMovementsPlayerOne->random(1)->first();

                    $avaliableMovementsPlayerTwo = $pieceOne->avaliableMovements($firstMovePlayerTwo->position_x, $firstMovePlayerTwo->position_y, $dimensions);
                    $randomAvaliableMovementPlayerTwo = $avaliableMovementsPlayerTwo->random(1)->first();



                    $firstMovePlayerOne = $this->createPlayerMovement(
                        $pieceOne->id,
                        $playerOne,
                        $firstMovePlayerOne->position_x + $randomAvaliableMovementPlayerOne->movement_x,
                        $firstMovePlayerOne->position_y + $randomAvaliableMovementPlayerOne->movement_y
                    );
                    $firstMovePlayerTwo = $this->createPlayerMovement(
                        $pieceTwo->id,
                        $playerTwo,
                        $firstMovePlayerTwo->position_x + $randomAvaliableMovementPlayerTwo->movement_x,
                        $firstMovePlayerTwo->position_y + $randomAvaliableMovementPlayerTwo->movement_y
                    );
                    $cont++;
                } catch (\Throwable $th) {
                    dd($th->getMessage());
                }
            }
        } catch (QueryException $th) {
            dd($th->getMessage());
        }
    }
    public function createPlayerMovement($piece, $player, $positionX, $positionY)
    {
        return $this->playerMovements()->create([
            'player_id' => $player,
            'chess_piece_id' => $piece,
            'position_x' => $positionX,
            'position_y' => $positionY,
        ]);
    }
}
