<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $now = Carbon::now();

        $classrooms = [
            ['id' => 1, 'major_id' => 1, 'level' => 'first'],
            ['id' => 2, 'major_id' => 1, 'level' => 'second'],
            ['id' => 3, 'major_id' => 1, 'level' => 'third'],

            ['id' => 4, 'major_id' => 2, 'level' => 'first'],
            ['id' => 6, 'major_id' => 2, 'level' => 'second'],
            ['id' => 7, 'major_id' => 2, 'level' => 'third'],

            ['id' => 8,  'major_id' => 3, 'level' => 'first'],
            ['id' => 10, 'major_id' => 3, 'level' => 'second'],
            ['id' => 11, 'major_id' => 3, 'level' => 'third'],

            ['id' => 12, 'major_id' => 4, 'level' => 'first'],
            ['id' => 13, 'major_id' => 4, 'level' => 'second'],
            ['id' => 14, 'major_id' => 4, 'level' => 'third'],

            ['id' => 15, 'major_id' => 5, 'level' => 'first'],
            ['id' => 16, 'major_id' => 5, 'level' => 'second'],
            ['id' => 18, 'major_id' => 5, 'level' => 'third'],

            ['id' => 19, 'major_id' => 6, 'level' => 'first'],
            ['id' => 20, 'major_id' => 6, 'level' => 'second'],
            ['id' => 21, 'major_id' => 6, 'level' => 'third'],

            ['id' => 22, 'major_id' => 7, 'level' => 'first'],
            ['id' => 23, 'major_id' => 7, 'level' => 'second'],
            ['id' => 24, 'major_id' => 7, 'level' => 'third'],
        ];

        foreach ($classrooms as $classroom) {
            DB::table('classrooms')->insert([
                'id' => $classroom['id'],
                'major_id' => $classroom['major_id'],
                'level' => $classroom['level'],
                'name' => null,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,
            ]);

            $this->command->info("Classroom added: Major ID: {$classroom['major_id']} | Level: {$classroom['level']}");
        }
    }
}
