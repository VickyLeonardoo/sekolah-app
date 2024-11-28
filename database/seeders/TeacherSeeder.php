<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::create([
            'name' => 'Suprianto S. Pd., M. Pd',
            'email' => 'supri@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123'),
            'phone' => '0888888',
            'identity_no' => 'NIP22210',
        ]);

        $user2 = User::create([
            'name' => 'Dona Amalia S. Pd., M. Pd',
            'email' => 'dona@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123'),
            'phone' => '08818828',
            'identity_no' => 'NIP21210',
        ]);

        $user3 = User::create([
            'name' => 'Santi S. Pd., M. Pd',
            'email' => 'santi@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123'),
            'phone' => '0333888',
            'identity_no' => 'NIP22110',
        ]);

        $user4 = User::create([
            'name' => 'Riyan S. Pd., M. Pd',
            'email' => 'riyan@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123'),
            'phone' => '0889788',
            'identity_no' => 'NIP66210',
        ]);

        $teacher1 = Teacher::create([
            'user_id' => $user1->id,
            'photo' => 'aaaaaauser1.jpg'
        ]);

        $teacher2 = Teacher::create([
            'user_id' => $user2->id,
            'photo' => 'aaaaaauser2.jpg'
        ]);

        $teacher3 = Teacher::create([
            'user_id' => $user3->id,
            'photo' => 'aaaaaauser3.jpg'
        ]);

        $teacher4 = Teacher::create([
            'user_id' => $user4->id,
            'photo' => 'aaaaaauser4.jpg'
        ]);
    }
}
