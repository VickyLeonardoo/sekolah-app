<?php

namespace Database\Seeders;

use App\Models\SchoolClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // major_id
        // max_student
        SchoolClass::create(['name' => 'IF A', 'grade' => '10', 'major_id' => '1', 'max_student' => '30']);
        SchoolClass::create(['name' => 'IF A', 'grade' => '11', 'major_id' => '1', 'max_student' => '30']);
        SchoolClass::create(['name' => 'IF A', 'grade' => '12', 'major_id' => '1', 'max_student' => '30']);
        
        SchoolClass::create(['name' => 'IF B', 'grade' => '10', 'major_id' => '1', 'max_student' => '30']);
        SchoolClass::create(['name' => 'IF B', 'grade' => '11', 'major_id' => '1', 'max_student' => '30']);
        SchoolClass::create(['name' => 'IF B', 'grade' => '12', 'major_id' => '1', 'max_student' => '30']);

        SchoolClass::create(['name' => 'IF C', 'grade' => '10', 'major_id' => '1', 'max_student' => '30']);
        SchoolClass::create(['name' => 'IF C', 'grade' => '11', 'major_id' => '1', 'max_student' => '30']);
        SchoolClass::create(['name' => 'IF C', 'grade' => '12', 'major_id' => '1', 'max_student' => '30']);
    
    }
}
