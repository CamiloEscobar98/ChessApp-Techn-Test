<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\PlayerMovementResource;

use function PHPUnit\Framework\isNull;

class GamingPlayerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'player_one' => $this->playerOne->name,
            'player_two' => $this->playerTwo->name,
            'winner' => isNull($this->playerWinner) ? null : $this->playerWinner->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'movements' => PlayerMovementResource::collection($this->playerMovements)
        ];
    }
}
