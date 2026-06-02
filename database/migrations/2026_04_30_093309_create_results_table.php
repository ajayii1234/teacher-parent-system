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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
    
            $table->integer('ca_score');     // Continuous Assessment
            $table->integer('exam_score');   // Exam
    
            $table->integer('total');        // Auto-calculated
            $table->string('grade');        // A–F
    
            $table->string('term');         // First Term, Second Term
            $table->string('session');      // 2025/2026
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
