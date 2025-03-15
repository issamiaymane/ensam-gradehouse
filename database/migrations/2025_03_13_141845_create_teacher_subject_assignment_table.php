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
        // database/migrations/xxxx_xx_xx_create_teacher_subject_assignment_table.php
        Schema::create('teacher_subject_assignment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
            $table->foreignId('classroom_subject_id')->constrained('classroom_subject')->onDelete('cascade');
            // Donner un nom plus court à l'index unique
            $table->unique(['teacher_id', 'classroom_subject_id'], 'teacher_subject_unique');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_subject_assignment');
    }
};
