<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class ChessTable extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'chess_tables';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'dimensions'];

    /**
     * Set the ChessTable's name.
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        return $this->attributes['name'] = Str::lower($value);
    }

    /**
     * Get the ChessTable's name.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    /**
     * Get the ChessTable's dimensions.
     *
     * @param  string  $value
     * @return string
     */
    public function getDimensionsTransformAttribute()
    {
        return $this->dimensions . "x" . $this->dimensions;
    }

    /**
     * Get the Chess Squares which are relationed with the ChessTable.
     * 
     * @return ChessSquare[] $chessSquares
     */
    public function chessSquares()
    {
        return $this->hasMany(ChessSquare::class);
    }
}
