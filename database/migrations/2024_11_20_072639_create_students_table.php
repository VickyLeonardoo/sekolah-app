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
            $table->string('identity_no')->unique();
            $table->foreignId('major_id')->constrained();
            $table->string('name');
            $table->string('gender');
            $table->string('religion');
            $table->date('dob');
            $table->string('phone')->nullable();
            $table->string('address');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('father_phone')->nullable();
            $table->string('mother_phone')->nullable();
            $table->boolean('is_graduated')->default(false);
            $table->integer('account_created')->default(0);
            $table->integer('grade')->default(10);
            $table->text('photo')->nullable();
            $table->softDeletes();
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
