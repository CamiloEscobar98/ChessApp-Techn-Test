<?php

namespace App\Models\Game;

use App\Models\Player;
use Illuminate\Database\Eloquent\Model;

class GamingPlayer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gaming_players';

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


}
