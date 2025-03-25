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
        // database/migrations/xxxx_xx_xx_create_classroom_subject_table.php
        Schema::create('classroom_subject', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classroom_school_year_id')->constrained('classroom_school_year')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            $table->string('subject_code');
            $table->string('semester');
            $table->unique(['classroom_school_year_id', 'subject_id', 'subject_code', 'semester'], 'classroom_subject_unique');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classroom_subject');
    }
};
