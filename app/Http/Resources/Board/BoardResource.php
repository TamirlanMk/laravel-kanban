<?php

namespace App\Http\Resources\Board;

use App\Http\Resources\BoardColumn\BoardColumnResource;
use App\Http\Resources\BoardLabel\BoardLabelResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BoardResource extends JsonResource
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
            'name' => $this->name,
            'is_public' => $this->is_public,

            'cards_count' => $this->whenCounted('cards'),

            'columns' => BoardColumnResource::collection(
                $this->whenLoaded('columns')
            ),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
