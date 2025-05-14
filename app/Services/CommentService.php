<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;

class CommentService
{
    public function createComment(array $data)
    {
        return Comment::create($data);
    }

    public function updateComment(User $user , array $data , $id){
        $comment = Comment::findOrFail($id);

        if(! $user->can('update',$comment) )
              throw new AuthorizationException('Unauthorized');

        $comment->update($data) ;
        return $comment ;
    }
    
    public function deleteComment(User $user ,$id)
    {
        $comment = Comment::findOrFail($id);
        if(! $user->can('delete',$comment) )
              throw new AuthorizationException('Unauthorized');
        
        $comment->delete();
    }

    public function taskComments($id)
    {
        $task = Task::findOrFail($id) ;
        return $task->comments;
    }
}
