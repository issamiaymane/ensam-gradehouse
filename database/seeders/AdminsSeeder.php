<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Admin;

class AdminsSeeder extends Seeder
{
    public function run()
    {
        // Example admin data with nullable phone and password
        $admins = [
            ['admin', 'admin', null], // First name and last name, password will be generated randomly
        ];

        foreach ($admins as $admin) {
            $firstName = ucfirst(strtolower($admin[0])); // Capitalize first letter of first name
            $lastName = ucfirst(strtolower($admin[1])); // Capitalize first letter of last name
            $phone = $admin[2]; // This can be null

            // Generate a random password with 12 characters
            $randomPassword = Str::random(12);

            // Create the user with the random password and the custom email format
            $email = strtolower($firstName) . '@ensam.um5.ac.ma'; // Custom email format

            // Create the user
            $user = User::create([
                'first_name' => $firstName,
                'last_name' => $lastName, // Using the actual last name
                'email' => $email, // Custom email format
                'password' => Hash::make($randomPassword), // Password is hashed
                'role' => 'admin',
            ]);

            // Create the admin and associate with the user
            Admin::create([
                'user_id' => $user->id,
                'phone' => $phone,  // This can be null
                'service' => null,  // Not used
            ]);

            // Display the details in the console for testing
            $this->command->info("Admin added: Email: {$email} | Password: {$randomPassword}");
        }
    }
}


