<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;
use Dom\Comment;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login'   , 'login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(AuthController::class)->group(function(){
        Route::get('user', 'user');
        Route::post('logout','logout');
    });

    Route::controller(TaskController::class)->group(function(){
        Route::get('myTasks','myTasks');
        Route::get('taskStatus/{id}','taskStatus');
    });

    Route::get('comments/task/{id}',[TaskController::class,'getAllCommnets']);
});

Route::middleware(['auth:sanctum' , 'role:super_admin,moderator,limited_admin'])->group(function(){

    Route::controller(TaskController::class)->group(function(){

        Route::get('tasks','index');
        Route::get('tasks/{id}','show');
        Route::get('tasks/commnets','comments');
        Route::post('tasks','store');
        Route::delete('tasks/{id}','destroy');
        Route::put('tasks/{id}','update');
    });

    Route::controller(UserController::class)->group(function(){
        
        Route::get('users','index');
        Route::get('users/{id}','show');
        Route::put('users/{id}','update')->middleware('role:super-admin');;
        Route::delete('users/{id}','destroy')->middleware('role:super-admin');;
    });

    Route::controller(StatusController::class)->group(function(){
        Route::get('statuses','index');
        Route::post('statuses','store')->middleware('role:super-admin');
        Route::get('statuses/{id}','show');
        Route::delete('statuses/{id}','destroy')->middleware('role:super-admin');
    });
});


Route::middleware('auth:sanctum')->group(function () {
    Route::controller(CommentController::class)->group(function(){
        Route::post('comments','create');
        Route::put('comments','update');
        Route::delete('comments','destroy');
    });
});
