<?php

namespace App\Http\Resources\Card;

use App\Http\Resources\BoardLabel\BoardLabelResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
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
            'title' => $this->title,
            'position' => $this->position,
            'description' => $this->description,
            'board_column_id' => $this->board_column_id,

            'column' => $this->whenLoaded('column'),

            'todos_count' => $this->whenCounted('todos'),
            'comments_count' => $this->whenCounted('comments'),
            'attachments_count' => $this->whenCounted('attachments'),

            'labels' => BoardLabelResource::collection(
                $this->whenLoaded('labels')
            ),

            'ready_at' => $this->ready_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
