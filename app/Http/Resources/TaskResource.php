<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'status'      => $this->status , 
            'assignedUser'=> new UserResource($this->user),
            'create-by'   => new UserResource($this->creator),
            'priority'    => $this->priority,
            'created_at'  => $this->created_at->toDateTimeString(),
            "updated-at" => ($this->created_at != $this->updated_at) ? $this->updated_at->toDateTimeString() : "not update yet" ,

        ];
    }
}
