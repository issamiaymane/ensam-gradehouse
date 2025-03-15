<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subjects')->insert([
            ['name' => 'Programmation en Java'],
            ['name' => 'Bases de données'],
            ['name' => 'Architecture des ordinateurs'],
            ['name' => 'Algèbre linéaire'],
            ['name' => 'Analyse mathématique'],
        ]);
    }
}
