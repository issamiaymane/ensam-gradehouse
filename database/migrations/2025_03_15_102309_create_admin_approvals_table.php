<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminApprovalsTable extends Migration
{
    public function up()
    {
        Schema::create('admin_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grade_id')->constrained('grades');
            $table->foreignId('admin_id')->constrained('users');
            $table->enum('status', ['approved', 'rejected']);
            $table->text('comment');
            $table->timestamp('reviewed_at');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin_approvals');
    }
}
