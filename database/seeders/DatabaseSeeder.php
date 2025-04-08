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
            StudentsSeeder::class,
            MajorsSeeder::class,
            SubjectsSeeder::class,
            ClassroomSeeder::class,
        ]);
    }
}
