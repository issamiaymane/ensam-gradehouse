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
        // Inserting all the subjects into the 'subjects' table
        DB::table('subjects')->insert([
            ['name' => 'Python pour Data Science'],
            ['name' => 'Machine Learning'],
            ['name' => 'Programmation en Java'],
            ['name' => 'UML'],
            ['name' => 'Développement personnel'],
            ['name' => 'Développement professionnel'],
            ['name' => 'Français'],
            ['name' => 'Anglais'],
            ['name' => 'PL/SQL'],
            ['name' => 'Bases de données NOSQL'],
            ['name' => 'Statistique inférentielle'],
            ['name' => 'Analyse de données'],
            ['name' => 'Développement Front-end'],
            ['name' => 'Développement Backend-end'],
            ['name' => 'Système d\'information hospitalier'],
            ['name' => 'Projet d\'ingénierie numérique appliquée à la santé'],
            ['name' => 'Business Intelligence'],
            ['name' => 'Data Visualisation'],
            ['name' => 'Routage et communication'],
            ['name' => 'Administration système'],
            ['name' => 'Big Data'],
            ['name' => 'Cryptographie'],
            ['name' => 'Sécurité des réseaux LAN'],
            ['name' => 'Economie de l\'entreprise II'],
            ['name' => 'Contrôle de gestion'],
            ['name' => 'Processus pour l\'insertion professionnelle (PIP)'],
            ['name' => 'L\'analyse transactionnelle'],
            ['name' => 'Culture arabe et la science'],
        ]);
    }
}

