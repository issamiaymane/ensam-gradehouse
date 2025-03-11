<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomsTable extends Migration
{
    public function up()
    {
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('major_id')->constrained('majors');
            $table->enum('level_year', ['first', 'second', 'third']);
            $table->string('school_year');
            $table->timestamps();

            $table->unique(['major_id', 'level_year', 'school_year']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('classrooms');
    }
}
