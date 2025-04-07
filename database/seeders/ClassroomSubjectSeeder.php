<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassroomSubject;
use App\Models\ClassroomSchoolYear;
use App\Models\Subject;

class ClassroomSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $firstList = [
            ['name' => 'Python pour Data Science', 'code' => 'M1.1'],
            ['name' => 'Machine Learning', 'code' => 'M1.2'],
            ['name' => 'Programmation en Java', 'code' => 'M2.1'],
            ['name' => 'UML', 'code' => 'M2.2'],
            ['name' => 'Développement personnel', 'code' => 'M3.1'],
            ['name' => 'Développement professionnel', 'code' => 'M3.2'],
            ['name' => 'Français', 'code' => 'M4.1'],
            ['name' => 'Anglais', 'code' => 'M4.2'],
            ['name' => 'PL/SQL', 'code' => 'M5.1'],
            ['name' => 'Bases de données NOSQL', 'code' => 'M5.2'],
            ['name' => 'Statistique inférentielle', 'code' => 'M6.1'],
            ['name' => 'Analyse de données', 'code' => 'M6.2'],
            ['name' => 'Développement Front-end', 'code' => 'M7.1'],
            ['name' => 'Développement Backend-end', 'code' => 'M7.2'],
        ];

        $secondList = [
            ['name' => 'Système d\'information hospitalier', 'code' => 'M1'],
            ['name' => 'Projet d\'ingénierie numérique appliquée à la santé', 'code' => 'M2'],
            ['name' => 'Business Intelligence', 'code' => 'M3.1'],
            ['name' => 'Data Visualisation', 'code' => 'M3.2'],
            ['name' => 'Routage et communication', 'code' => 'M4.1'],
            ['name' => 'Administration système', 'code' => 'M4.2'],
            ['name' => 'Big Data', 'code' => 'M5'],
            ['name' => 'Cryptographie', 'code' => 'M6.1'],
            ['name' => 'Sécurité des réseaux LAN', 'code' => 'M6.2'],
            ['name' => 'Economie de l\'entreprise II', 'code' => 'M7.1'],
            ['name' => 'Contrôle de gestion', 'code' => 'M7.2'],
            ['name' => 'Processus pour l\'insertion professionnelle (PIP)', 'code' => 'M8.1'],
            ['name' => 'L\'analyse transactionnelle', 'code' => 'M8.2'],
            ['name' => 'Culture arabe et la science', 'code' => 'M8.3'],
        ];

        $classroomYear1 = ClassroomSchoolYear::find(1);
        $classroomYear2 = ClassroomSchoolYear::find(2);

        foreach ($firstList as $subjectData) {
            $subject = Subject::firstOrCreate(['name' => $subjectData['name']]);
            ClassroomSubject::firstOrCreate([
                'classroom_school_year_id' => $classroomYear1->id,
                'subject_id' => $subject->id,
                'subject_code' => $subjectData['code'], // Use the manually defined code
                'semester' => 'S2',
            ]);
        }

        foreach ($secondList as $subjectData) {
            $subject = Subject::firstOrCreate(['name' => $subjectData['name']]);
            ClassroomSubject::firstOrCreate([
                'classroom_school_year_id' => $classroomYear2->id,
                'subject_id' => $subject->id,
                'subject_code' => $subjectData['code'], // Use the manually defined code
                'semester' => 'S4',
            ]);
        }

        $this->command->info("Classroom subjects have been seeded successfully.");
    }
}


