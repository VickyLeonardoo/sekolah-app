<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('academic_years', function (Blueprint $table) {
            $table->id();
            $table->year('start_year');       // Menyimpan tahun mulai
            $table->year('end_year');         // Menyimpan tahun berakhir
            $table->tinyInteger('start_month'); // Menyimpan bulan mulai (1-12)
            $table->tinyInteger('end_month');   // Menyimpan bulan berakhir (1-12)
            $table->float('price',14,2);
            $table->softDeletes();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_years');
    }
};
