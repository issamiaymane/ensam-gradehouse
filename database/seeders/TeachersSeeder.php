<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Teacher;

class TeachersSeeder extends Seeder
{
    public function run()
    {
        $teachers = [
            ['Abderrahim', 'EL QADI', 'a.elqadi@um5r.ac.ma'],
            ['Reda', 'CHEFIRA', 'chefira.reda@gmail.com'],
            ['Mohammed', 'BEKKALI', 'bekkalimohammed@gmail.com'],
            ['Mourad', 'EL YADARI', 'm.elyadari@um5r.ac.ma'],
            ['Lahcen', 'AZRAR', 'l.azrar@um5r.ac.ma'],
            ['Mustapha', 'JOHRI', 'm.johri@um5r.ac.ma'],
            ['Soukaina', 'BEKKARI', 's.bekkari@um5r.ac.ma'],
            ['Ayoub', 'ABDELLAOUI', 'ayoub.abdellaoui@gmail.com'],
            ['Ilham', 'SADOQI', 'ilhamsadoqi2@gmail.com'],
            ['Khalid', 'HACINI', 'hacinikhalid@gmail.com'],
            ['Maria', 'ZEMZAMI', 'maria.zemzami@gmail.com'],
            ['Saadia', 'BENZAGHAR', 's.benzaghar@um5r.ac.ma'],
            ['Chafik', 'NACIR', 'c.nacir@um5r.ac.ma'],
            ['Sophia', 'ALAMI KAMOURI', 's.alami@um5r.ac.ma'],
            ['Abdelkrim', 'BENFATIMA', 'a.benfatima@um5r.ac.ma'],
            ['Saida', 'TAFROAOUTI IDRISSI', 's.tafraouti@um5r.ac.ma'],
            ['Khaddouj', 'KARIM', 'k.karim@um5r.ac.ma'],
            ['Mohamed', 'ZERIAB ES-SADEK']
        ];

        foreach ($teachers as $teacher) {
            $password = Str::random(10); // Génère un mot de passe aléatoire
            $user = User::create([
                'first_name' => $teacher[0],
                'last_name' => $teacher[1],
                'email' => $teacher[2],
                'password' => Hash::make($password),
                'role' => 'teacher',
            ]);

            Teacher::create([
                'user_id' => $user->id,
                'phone' => null, // Phone NULL
                'department' => 'Mathématiques Appliquées & Génie Informatique',
            ]);

            // Affiche les identifiants dans la console pour test
            $this->command->info("Professeur added: {$teacher[2]} | Password: $password");
        }
    }
}
