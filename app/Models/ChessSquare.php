<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChessSquare extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'chess_squares';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['chess_table_id', 'position_x', 'position_y'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the Chesstable which is relationed with Chess Square.
     * 
     * @return ChessTable $chessTable
     */
    public function chessTable()
    {
        return $this->belongsTo(ChessTable::class);
    }
}
