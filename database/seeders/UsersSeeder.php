<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => 'ADMIN',
            'email' => 'admin@gmail.com',
            'password' => '$2y$12$7cQb01Hih9G0BrrsvYcqR.dathe34Sn5hareqWNpuJ78bVsc/bede',
            'role' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
