<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Player extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'players';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'phone'];

    /**
     * Set the Player's name.
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        return $this->attributes['name'] = Str::lower($value);
    }

    /**
     * Get the Player's name.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }
    
    /**
     * Set the Player's email.
     *
     * @param  string  $value
     * @return void
     */
    public function setEmailAttribute($value)
    {
        return $this->attributes['email'] = Str::lower($value);
    }
}
