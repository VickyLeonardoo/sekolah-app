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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('identity_no');
            $table->string('name');
            $table->string('gender');
            $table->string('religion');
            $table->date('dob');
            $table->string('phone');
            $table->string('address');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('fathmoer_phone');
            $table->string('mother_phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
