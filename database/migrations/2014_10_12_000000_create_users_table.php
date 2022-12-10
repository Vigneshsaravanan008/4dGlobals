<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id')->unique()->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_no')->unique()->nullable();
            $table->integer('role_id')->comment('1:Agent;2:Supervisor');
            $table->integer('department_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('is_login')->default(0);
            $table->timestamp('login_time')->nullable();
            $table->timestamp('logout_time')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
