<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name'     => 'super_admin1',
                'password' => bcrypt('password'),
                'email'    => 'admin1@email.com',
                'role'     => 'super_admin'
            ],
            [
                'name'     => 'moderator1',
                'password' => bcrypt('password'),
                'email'    => 'moderator1@email.com',
                'role'     => 'moderator'
            ],
            [
                'name'     => 'moderator2',
                'password' => bcrypt('password'),
                'email'    => 'moderator2@email.com',
                'role'     => 'moderator'
            ],
            [
                'name'     => 'limited_admin1',
                'password' => bcrypt('password'),
                'email'    => 'limited_admin1@email.com',
                'role'     => 'limited_admin'
            ]
        ]);
    }
}
