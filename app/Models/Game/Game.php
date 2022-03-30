<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

use Database\Factories\GameFactory;

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
    protected $fillable = ['chess_table_id', 'name', 'game_status'];

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
     * Get the GameState which is relationed with Game.
     * 
     * @return GameState $gameState
     */
    public function gameState()
    {
        return $this->belongsTo(GameState::class);
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
}