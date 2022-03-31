<?php

namespace App\Models\Game;

use App\Models\Chess\ChessTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

use Database\Factories\GameFactory;

use App\Models\Player;

class Game extends Model
{
    use HasFactory;

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory()
    {
        return GameFactory::new();
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'games';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['chess_table_id', 'name', 'game_status', 'automatic_mode'];

    /**
     * Set the Game's name.
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        return $this->attributes['name'] = Str::lower($value);
    }

    /**
     * Get the Game's name.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    /**
     * Get the Game's automatic mode converted.
     *
     * @param  string  $value
     * @return string
     */
    public function getAutomaticModeConvertedAttribute($value)
    {
        return $value ? "Automatic Mode" : "Manual Mode";
    }

    /**
     * Get the GameState which is relationed with Game.
     * 
     * @return GameState $gameState
     */
    public function gameState()
    {
        return $this->belongsTo(GameState::class);
    }

    /**
     * Get the ChessTable which is relationed with Game.
     * 
     * @return ChessTable $chessTable
     */
    public function chessTable()
    {
        return $this->belongsTo(ChessTable::class);
    }

    /**
     * Get the GamingPlayer which is relationed with Game.
     * 
     * @return GameState $gameState
     */
    public function gamingPlayer()
    {
        return $this->hasOne(GamingPlayer::class);
    }

    /**
     * Get the PlayerOne which is relationed with Game.
     * 
     * @return Player $player
     */
    public function playerOne()
    {
        return $this->belongsToMany(Player::class, "gaming_players", null, 'player_one_id');
    }

    /**
     * Get the PlayerOne which is relationed with Game.
     * 
     * @return Player $player
     */
    public function playerTwo()
    {
        return $this->belongsToMany(Player::class, "gaming_players", null, 'player_two_id');
    }

    /**
     * Get the PlayerOne which is relationed with Game.
     * 
     * @return Player $player
     */
    public function playerWinner()
    {
        return $this->belongsToMany(Player::class, "gaming_players", null, 'player_winner_id');
    }
}
