<?php

namespace Database\Seeders;

use App\Models\Comment ;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $tasks = Task::all();

        foreach ($tasks as $task) {
            // We add 1 to 3 random comments to each task.
            foreach (range(1, rand(1, 3)) as $i) {
                Comment::create([
                    'content' => "comment $i on task : {$task->title}",
                    'task_id' => $task->id,
                    'user_id' => $users->random()->id,
                ]);
            }
        }
    }
}
