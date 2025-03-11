<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MajorSeeder extends Seeder
{
    public function run()
    {
        DB::table('majors')->insert([
            ['code' => 'INDIASD', 'name' => 'Ingénierie Numérique en Data science, Intelligence Artificielle & Santé Digitale'],
            ['code' => 'EEIN', 'name' => 'Énergie Électrique et Industrie Numérique'],
            ['code' => 'IAA', 'name' => 'Ingénierie Mécanique pour l’Industrie Aéronautique'],
            ['code' => 'GM', 'name' => 'Ingénieur Génie Mécanique'],
            ['code' => 'ISE', 'name' => 'Ingénierie des Systèmes Energétiques'],
            ['code' => 'GBM', 'name' => 'Génie Biomédical'],
            ['code' => 'GME', 'name' => 'Génie des Matériaux, qualité et Environnement'],
        ]);
    }
}
