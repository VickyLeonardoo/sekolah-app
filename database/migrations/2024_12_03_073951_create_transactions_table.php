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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_no');
            $table->foreignId('student_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->float('amount',15,2);
            $table->string('month');
            $table->string('proof_image');
            $table->enum('status',['pending','approved','rejected']);
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
