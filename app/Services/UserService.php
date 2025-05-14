<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    /**
     * Get a paginated list of all users.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllUsers()
    {
        $users = User::paginate(3);
        return $users;
    }

    /**
     * Retrieve a single user by their ID.
     *
     * @param string $id
     * @return \App\Models\User
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getUser(string $id)
    {
        $user = User::findOrFail($id);
        return $user;
    }

    /**
     * Update the role of a specific user.
     *
     * @param array $data    // ['role' => 'new_role']
     * @param string $id     // User ID
     * @return \App\Models\User
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function updateUserRole(array $data, string $id)
    {
        $user = User::findOrFail($id);
        $user->role = $data['role'];
        $user->save();
        return $user;
    }

    /**
     * Delete a user by their ID.
     *
     * @param string $id
     * @return void
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function deleteUser(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }
}

