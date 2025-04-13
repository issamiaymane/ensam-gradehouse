<?php

namespace Database\Seeders;

use App\Models\ClassroomSubject;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AdminsSeeder::class,
            TeachersSeeder::class,
            MajorsSeeder::class,
            ClassroomSeeder::class,
            SubjectsSeeder::class,


        ]);
    }
}
