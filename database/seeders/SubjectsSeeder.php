<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class SubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // Liste des matières avec les semestres à l'intérieur
        $subjects = [
            ['code' => 'M1.1', 'name' => 'Python pour Data Science', 'semester' => 'SEM1'],
            ['code' => 'M1.2', 'name' => 'Machine Learning', 'semester' => 'SEM1'],
            ['code' => 'M2.1', 'name' => 'Programmation en Java', 'semester' => 'SEM1'],
            ['code' => 'M2.2', 'name' => 'UML', 'semester' => 'SEM1'],
            ['code' => 'M3.1', 'name' => 'Développement personnel', 'semester' => 'SEM1'],
            ['code' => 'M3.2', 'name' => 'Développement professionnel', 'semester' => 'SEM1'],
            ['code' => 'M4.1', 'name' => 'Mécanismes du débat culturel', 'semester' => 'SEM1'],
            ['code' => 'M4.2', 'name' => 'Academic English 2', 'semester' => 'SEM1'],
            ['code' => 'M5.1', 'name' => 'PL/SQL', 'semester' => 'SEM2'],
            ['code' => 'M5.2', 'name' => 'Bases de données NOSQL', 'semester' => 'SEM2'],
            ['code' => 'M6.1', 'name' => 'Statistique inférentielle', 'semester' => 'SEM2'],
            ['code' => 'M6.2', 'name' => 'Analyse de données', 'semester' => 'SEM2'],
            ['code' => 'M7.1', 'name' => 'Développement Front-end', 'semester' => 'SEM2'],
            ['code' => 'M7.2', 'name' => 'Développement Backend-end', 'semester' => 'SEM2'],
            ['code' => 'M1', 'name' => 'Système d\'information hospitalier', 'semester' => 'SEM2'],
            ['code' => 'M2', 'name' => 'Projet d\'ingénierie numérique appliquée à la santé', 'semester' => 'SEM2'],
            ['code' => 'M3.1', 'name' => 'Business Intelligence', 'semester' => 'SEM2'],
            ['code' => 'M3.2', 'name' => 'Data Visualisation', 'semester' => 'SEM2'],
            ['code' => 'M4.1', 'name' => 'Routage et communication', 'semester' => 'SEM2'],
            ['code' => 'M4.2', 'name' => 'Administration système', 'semester' => 'SEM2'],
            ['code' => 'M5', 'name' => 'Big Data', 'semester' => 'SEM2'],
            ['code' => 'M6.1', 'name' => 'Cryptographie', 'semester' => 'SEM2'],
            ['code' => 'M6.2', 'name' => 'Sécurité des réseaux LAN', 'semester' => 'SEM2'],
            ['code' => 'M7.1', 'name' => 'Economie de l\'entreprise II', 'semester' => 'SEM2'],
            ['code' => 'M7.2', 'name' => 'Contrôle de gestion', 'semester' => 'SEM2'],
            ['code' => 'M8.1', 'name' => 'Processus pour l\'insertion professionnelle (PIP)', 'semester' => 'SEM2'],
            ['code' => 'M8.2', 'name' => 'L\'analyse transactionnelle', 'semester' => 'SEM2'],
            ['code' => 'M8.3', 'name' => 'Culture arabe et la science', 'semester' => 'SEM2'],
        ];

        foreach ($subjects as $index => $subject) {
            $classroomId = $index < 14 ? 1 : 2; // Classes 1 à 14 vont au classroom_id = 1, les autres au classroom_id = 2

            DB::table('subjects')->insert([
                'name' => $subject['name'],
                'subject_code' => $subject['code'],
                'semester' => $subject['semester'],
                'classroom_id' => $classroomId,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,
            ]);

            $this->command->info("Subject ajouté : {$subject['code']} - {$subject['name']} ");
        }
    }
}
