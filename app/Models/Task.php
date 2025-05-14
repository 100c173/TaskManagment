<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status_id',
        'user_id',
        'created_by',
        'priority',
    ];

    //The person to whom the task is assigned
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // the Admin who created the task 
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    // Perform deletion when deleting the user
    public static function booted (){
        static::deleting( function($task) {
            // Delete all tasks for this user
            $task->comments()->delete();
        });
    }
}
