<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\GamingPlayerResource;

class GameResource extends JsonResource
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
            'name' => $this->name,
            'game_state' => $this->gameState->name,
            'game_mode' => $this->automatic_mode_converted,
            'game_dates' => [
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'gaming_playing' => new GamingPlayerResource($this->gamingPlayer)
        ];
    }
}
