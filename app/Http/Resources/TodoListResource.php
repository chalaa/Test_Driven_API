<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TodoListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "name" => $this->name,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "user" => new UserResource($this->user),
            "task" => TodoListTaskResource::collection($this->tasks)
        ];
    }
}
