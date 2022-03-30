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
}
