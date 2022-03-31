<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Game\GamingPlayer;
use App\Models\Chess\ChessPiece;
use App\Models\Player;

class PlayerMovement extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'player_movements';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['gaming_player_id', 'player_id', 'chess_piece_id', 'position_x', 'position_y'];

    /**
     * Get the GamingPlayer which is relationed with PlayerMovement.
     * 
     * @return GamingPlayer $gamingPlayer
     */
    public function gamingPlayer()
    {
        return $this->belongsTo(GamingPlayer::class);
    }

    /**
     * Get the Player which is relationed with PlayerMovement.
     * 
     * @return Player $player
     */
    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    /**
     * Get the ChessPiece which is relationed with PlayerMovement.
     * 
     * @return ChessPiece $chessPiece
     */
    public function chessPiece()
    {
        return $this->belongsTo(ChessPiece::class);
    }
}
