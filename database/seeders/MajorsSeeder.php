<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MajorsSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        $majors = [
            ['code' => 'INDIASD', 'name' => 'Ingénierie Numérique en Data science, Intelligence Artificielle & Santé Digitale'],
            ['code' => 'EEIN', 'name' => 'Énergie Électrique et Industrie Numérique'],
            ['code' => 'IAA', 'name' => 'Ingénierie Mécanique pour l’Industrie Aéronautique'],
            ['code' => 'GM', 'name' => 'Ingénieur Génie Mécanique'],
            ['code' => 'ISE', 'name' => 'Ingénierie des Systèmes Energétiques'],
            ['code' => 'GBM', 'name' => 'Génie Biomédical'],
            ['code' => 'GME', 'name' => 'Génie des Matériaux, qualité et Environnement'],
        ];

        foreach ($majors as $major) {
            DB::table('majors')->insert([
                'code' => $major['code'],
                'name' => $major['name'],
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null, // not deleted
            ]);

            $this->command->info("Major added: {$major['name']} ({$major['code']})");
        }
    }
}
