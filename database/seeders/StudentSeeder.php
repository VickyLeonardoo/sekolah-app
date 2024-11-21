<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Student::create([
            'identity_no' => '1234567890',
            'name' => 'John Doe',
            'dob' => '2009-01-01',
            'major_id' => 1,
            'gender' => 'Laki - Laki',
            'religion' => 'Protestan',
            'phone' => '1234567890',
            'address' => 'Jl. Contoh No. 123',
            'father_name' => 'Father Name',
            'father_phone' => '1234567890',
            'mother_name' => 'Mother Name',
            'mother_phone' => '1234567890',
            // 'photo' => 'path/to/photo.jpg'
        ]);

        Student::create([
            'identity_no' => '2224567890',
            'name' => 'SarahJohn Doe',
            'dob' => '2009-01-01',
            'major_id' => 2,
            'gender' => 'Laki - Laki',
            'religion' => 'Protestan',
            'phone' => '1234567890',
            'address' => 'Jl. Contoh No. 123',
            'father_name' => 'Father Name',
            'father_phone' => '1234567890',
            'mother_name' => 'Mother Name',
            'mother_phone' => '1234567890',
            // 'photo' => 'path/to/photo.jpg'
        ]);

        Student::create([
            'identity_no' => '3334567890',
            'name' => 'David',
            'dob' => '2009-01-01',
            'major_id' => 3,
            'gender' => 'Laki - Laki',
            'religion' => 'Protestan',
            'phone' => '1234567890',
            'address' => 'Jl. Contoh No. 123',
            'father_name' => 'Father Name',
            'father_phone' => '1234567890',
            'mother_name' => 'Mother Name',
            'mother_phone' => '1234567890',
            // 'photo' => 'path/to/photo.jpg'
        ]);
    }
}
