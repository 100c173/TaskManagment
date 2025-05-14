<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'content'       => $this->content,
            'task'          => [ 'id' => $this->task->id , "title" => $this->task->title],
            'commented-by'  => $this->user->name,
            'created_at'    => $this->created_at->toDateTimeString(),
            "updated-at"    => ($this->created_at != $this->updated_at) ? $this->updated_at->toDateTimeString() : "not update yet" ,

        ];
    }
}
