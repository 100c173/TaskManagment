<?php

namespace App\Providers;

use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('status-destroy',function(Status $status){
            return $status->tasks()->count() == 0 ;
        });

        Gate::define('show-task-status',function(User $user , Task $task){
            return ($user->id == $task->user_id); 
        });
    }
}
