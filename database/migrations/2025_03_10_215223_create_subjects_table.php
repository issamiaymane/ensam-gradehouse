<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classroom_id')->constrained('classrooms');
            $table->string('code');
            $table->string('name');
            $table->timestamps();

            $table->unique(['classroom_id', 'code']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}
