<?php

namespace App\Models\Chess;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ChessPiece extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'chess_pieces';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Set the ChessPiece's name
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        return $this->attributes['name'] = Str::lower($value);
    }

    /**
     * Get the ChessPiece's name.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return Str::upper($value);
    }

    /**
     * Get all Piece Movements which are relationed with the ChessPiece.
     * 
     * @return PieceMovement[] $pieceMovements
     */
    public function movements()
    {
        return $this->hasMany(PieceMovement::class);
    }

    /**
     * Get all Piece Movements which are relationed with the ChessPiece in a specific position.
     * 
     * @param int $position_x
     * @param int $position_y
     * @return PieceMovement[] $pieceMovements
     */
    public function avaliableMovements($position_x, $position_y, $dimensions)
    {
        if (($position_x > 0 && $position_y > 0) && $position_x <= $dimensions && $position_y <= $dimensions) {
            return $this->movements->map(function ($movement) use ($position_x, $position_y, $dimensions) {
                $min_X = $position_x + $movement->movement_x;
                $min_Y = $position_y + $movement->movement_y;

                $max_X =   $movement->movement_x + $position_x;
                $max_Y = $movement->movement_y +  $position_y;

                if (($max_X < $dimensions && $min_X > 0) && ($max_Y < $dimensions && $min_Y > 0)) {
                    return $movement;
                } else {
                    return false;
                }
            })->reject(function ($value) {
                return $value === false;
            });
        } else {
            return [];
        }
    }
}
