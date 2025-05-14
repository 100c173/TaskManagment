<?php

namespace Database\Seeders;

use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $priorities = ['low', 'medium', 'high', 'urgent'];
        $users = User::where('role', 'user')->get();
        $admins = User::whereIn('role', ['super_admin', 'moderator', 'limited_admin'])->get();
        $statuses = Status::all();

        foreach ($users as $user) {
            for ($i = 1; $i <= 3; $i++) {
                Task::create([
                    'title' => "Task $i for {$user->name}",
                    'description' => "This is task $i assigned to user {$user->email}",
                    'status_id' => $statuses->random()->id,
                    'user_id' => $user->id,
                    'created_by' => $admins->random()->id,
                    'priority' => $priorities[array_rand($priorities)],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
