<?php

namespace App\Models\Chess;

use Illuminate\Database\Eloquent\Model;


class PieceMovement extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'piece_movements';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['chess_piece_id', 'movement_x', 'movement_y'];

    /**
     * Get the ChessPiece which is relationed with the PieceMovement.
     * 
     * @return ChessPiece $chessPiece
     */
    public function chessPiece()
    {
        return $this->belongsTo(ChessPiece::class);
    }
}
