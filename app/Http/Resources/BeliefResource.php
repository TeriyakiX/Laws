<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BeliefResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'start_date' => $this->start_date,
            'last_complate_date' => $this->last_complate_date,
            'end_date' => $this->end_date,
            'percent' => $this->percent,
            'is_сontinues' => $this->is_сontinues,
        ];
    }
}
