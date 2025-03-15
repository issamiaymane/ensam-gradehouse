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
        // database/migrations/xxxx_xx_xx_add_indexes.php
        Schema::table('classroom_school_year', function (Blueprint $table) {
            $table->index('classroom_id');
            $table->index('school_year');
        });

        Schema::table('classroom_subject', function (Blueprint $table) {
            $table->index('classroom_school_year_id');
        });

        Schema::table('grades', function (Blueprint $table) {
            $table->index('student_id');
            $table->index('teacher_subject_assignment_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
