<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AcademicYear::create(['start_year' => '2023', 'end_year' => '2024', 'start_month' => '8', 'end_month' => '7','price' => '135000', 'created_at' => now(), 'updated_at' => now(), 'is_active' => true]);
        AcademicYear::create(['start_year' => '2024', 'end_year' => '2025', 'start_month' => '8', 'end_month' => '7','price' => '135000', 'created_at' => now(), 'updated_at' => now()]);
        AcademicYear::create(['start_year' => '2025', 'end_year' => '2026', 'start_month' => '8', 'end_month' => '7','price' => '145000', 'created_at' => now(), 'updated_at' => now()]);
    }
}
