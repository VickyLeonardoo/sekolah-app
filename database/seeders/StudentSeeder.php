<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $students = [];
        for ($i = 1; $i <= 100; $i++) {
            $students[] = [
                'identity_no' => $faker->unique()->numerify('ID#######'),
                'major_id' => 1,
                'name' => $faker->name,
                'gender' => $faker->randomElement(['Male', 'Female']),
                'religion' => $faker->randomElement(['Islam', 'Protestan', 'Hindu', 'Buddha', 'Katolik']),
                'dob' => $faker->date('Y-m-d', '2010-12-31'),
                'phone' => $faker->optional()->phoneNumber,
                'address' => $faker->address,
                'father_name' => $faker->name('male'),
                'mother_name' => $faker->name('female'),
                'father_phone' => $faker->optional()->phoneNumber,
                'mother_phone' => $faker->optional()->phoneNumber,
                'is_graduated' => $faker->boolean(20), // 20% chance graduated
                'account_created' => $faker->numberBetween(0, 1),
                'grade' => $faker->numberBetween(10, 12),
                'photo' => $faker->optional()->imageUrl(),
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ];
        }

        DB::table('students')->insert($students);
    }

}
