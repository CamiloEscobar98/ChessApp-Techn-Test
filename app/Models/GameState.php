<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GameState extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'game_states';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Set the GameState's name.
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        return $this->attributes['name'] = Str::lower($value);
    }

    /**
     * Get the GameState's name.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return Str::upper($value);
    }

    /**
     * Get Games which are relationed with Game State.
     * 
     * @return Game[] $games
     */
    public function games()
    {
        return $this->hasMany(Game::class);
    }
}
