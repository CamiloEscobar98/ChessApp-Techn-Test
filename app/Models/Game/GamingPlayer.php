<?php

namespace App\Models\Game;

use App\Models\Player;
use Illuminate\Database\Eloquent\Relations\Pivot;

use App\Models\ChessTable;
use App\Models\PlayerMovement;

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
        return $this->belongsToMany(Player::class, null, null, GamingPlayer::class, 'player_one_id');
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
        return $this->hasMany(PlayerMovement::class);
    }
}
