<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Student;

class StudentsSeeder extends Seeder
{
    public function run()
    {
        $students1 = [
            ['22017716', 'Hajar', 'ABDELLAOUI'],
            ['22001601', 'Mohammed', 'AFIF'],
            ['22019919', 'Nada', 'AISSA'],
            ['22019322', 'Anas', 'AMCHAAR'],
            ['24019761', 'Fatima-Ezzahrae', 'AZIRI'],
            ['22018898', 'Taha', 'BACHIR EL BOUHALI'],
            ['22020730', 'Zaineb', 'BAHLOULI'],
            ['22020205', 'Douaa', 'BAMOHAMED'],
            ['22020397', 'Mohamed', 'BELFILALI MIMOUNE'],
            ['22018974', 'Mayssae', 'BELMILOUDI'],
            ['22017934', 'Hajar', 'BEN BASSOU'],
            ['22018033', 'Jaafar', 'BENABIDIBA'],
            ['22020542', 'Rim', 'BENAMAR'],
            ['22019157', 'Imrane', 'BENHADDOUCHE'],
            ['22019994', 'Inas', 'BENTOUNSI'],
            ['22016948', 'Hiba', 'BENZAHRA'],
            ['22026254', 'Kodjo Mathias', 'BLENOUME MATHEYENDOU'],
            ['24019319', 'Anass', 'BOUCHANNAFA'],
            ['22020327', 'Aymane', 'BOUHOU'],
            ['22018088', 'Seddik', 'BOUMHAMDI'],
            ['21003490', 'Basma', 'CHAOUKI'],
            ['22017995', 'Aya', 'COSTO'],
            ['22017760', 'Malak', 'DRISSI'],
            ['21017525', 'Yasmine', 'EL BOUCHIKHI'],
            ['22018880', 'Hafsa', 'EL FEKAK'],
            ['22017640', 'Maroua', 'EL HOUR'],
            ['22020198', 'Mohamed Amine', 'EL KALAI'],
            ['22018162', 'Mohammed-Ali', 'EL MADANI'],
            ['22020175', 'Abderrafea', 'ELAMRI'],
            ['24019442', 'Wissal', 'ELBIDALI'],
            ['22019093', 'Nizar', 'ENNADHYFY'],
            ['24019781', 'Assia', 'ES-SAOUITA'],
            ['22020917', 'Marouan', 'EZBAKHE'],
            ['22017668', 'Walid', 'FADLI'],
            ['22001496', 'Soufiane', 'FAKR'],
            ['22019338', 'Ilyas', 'FARDAOUI'],
            ['24019751', 'Yousra', 'GHANNAM'],
            ['22020181', 'Chaimae', 'HADDOUCHE'],
            ['22018298', 'Mohammed', 'HAMDOUCH'],
            ['22017594', 'Loubna', 'HAOUACH'],
            ['24020167', 'Khawla', 'HILALI'],
            ['22020494', 'Zaid', 'HSAIN'],
            ['22020240', 'Aymane', 'ISSAMI'],
            ['22001613', 'Houssam', 'KICHCHOU'],
            ['21016315', 'Hiba', 'LABIED'],
            ['22017857', 'Ridouan', 'LACHGAR'],
            ['21015521', 'Oussama', 'LACHGUER'],
            ['22018066', 'Abdelilah', 'LAGRIBI'],
            ['24019740', 'Omar', 'LOUAZRI'],
            ['22018931', 'Alae', 'MOUADEN'],
            ['22020489', 'Rim', 'MOUTAOUAFIQ'],
            ['22017726', 'Ahmed Taha', 'OUAHIDI'],
            ['24019745', 'Walae', 'OUAZZANI TAYBI'],
            ['21019904', 'Ikhlas', 'OUMAIR'],
            ['22018944', 'Amina', 'RAJI'],
            ['22017840', 'Doha', 'RISSE'],
            ['23023216', 'Yassine', 'SADDANE'],
            ['22017614', 'Saad', 'SAHRAOUI'],
            ['22018264', 'Majd', 'SAIDI'],
            ['22017711', 'Adam', 'SOROURI'],
            ['22020504', 'Hafsa', 'ZHARI'],
        ];

        $students2 = [
            ['22020491', 'Nada', 'LAARABI'],
            ['22018924', 'Yasmine', 'LAHLOU'],
            ['22017667', 'Sami', 'LASSRI'],
            ['22020482', 'Alaa', 'LOUARDIRI'],
            ['22020532', 'Sara', 'MAAOUNI'],
            ['24019725', 'Chaymae', 'MAHROUCHI'],
            ['22019059', 'Ahmed', 'MAKHCHOUNE'],
            ['22020550', 'Sanae', 'MANNANE'],
            ['22017981', 'Chaimae', 'MAOUJOU'],
            ['22018083', 'Imane', 'MASBAHI'],
            ['22020490', 'Salma', 'MASLOUKHI'],
            ['22020372', 'Mohamed', 'MECHBAL'],
            ['22020161', 'Walid', 'MEDGOURI'],
            ['22018029', 'Aya', 'MERABTI'],
            ['22020509', 'Anas', 'MERBOUH'],
            ['22020507', 'Yahya', 'MERZOUKI'],
            ['22020497', 'Aya', 'MOULAY EL MEHDI'],
            ['22020493', 'Amine', 'MRANI'],
            ['24019783', 'Imane', 'MRHARI'],
            ['22018248', 'Hamza', 'NABIL'],
            ['24019723', 'Nour', 'NADARI'],
            ['22020381', 'Oumaima', 'NAJIH'],
            ['22017620', 'Taha', 'NASSEREDDINE'],
            ['24019470', 'Oumaima', 'NEJJARI'],
            ['22020485', 'Lina', 'NEKOURI'],
            ['22017860', 'Rayan', 'OMARI'],
            ['24019732', 'Nada', 'OUAKIL'],
            ['22019179', 'Aya', 'OUBOUZID'],
            ['22018250', 'Ikram', 'OUFROUKH'],
            ['22017754', 'Zineb', 'OUZIF'],
            ['22020484', 'Walid', 'RAIH'],
            ['22017762', 'Youssef', 'RAZI'],
            ['24019780', 'Amal', 'RHAZI'],
            ['22020495', 'Aya', 'SAIDI'],
            ['24019820', 'Oussama', 'SALMI'],
            ['24019623', 'Imane', 'SENHAJI'],
            ['22017628', 'Mohammed', 'SIFAOUI'],
            ['24019464', 'Ines', 'SMAILI'],
            ['22020392', 'Abdelmajid', 'TAFERSITI'],
            ['22017636', 'Hamza', 'TAHIRI'],
            ['22018928', 'Ines', 'TANTANE'],
            ['22020506', 'Yassine', 'TOUIMI'],
            ['22018184', 'Badr', 'TOUILI'],
            ['22020486', 'Zineb', 'YOUSFI'],
        ];

        $allStudents = array_merge($students1, $students2);

        foreach ($allStudents as $student) {
            $apogee = $student[0];
            $firstName = ucfirst(strtolower($student[1]));
            $lastName = strtoupper($student[2]);
            $email = strtolower($firstName) . '_' . strtolower($lastName) . '@um5.ac.ma';

            $user = User::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'password' => Hash::make($apogee),
                'role' => 'student',
            ]);

            Student::create([
                'user_id' => $user->id,
                'apogee' => $apogee,
            ]);

            $this->command->info("Student added: $email | Apogee: $apogee");
        }
    }
}
