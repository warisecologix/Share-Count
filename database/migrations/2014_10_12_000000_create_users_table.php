<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('user_name')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_no');
            $table->string('phone_code')->nullable();
            $table->string('email');
            $table->string('password')->nullable();
            $table->integer('verified_user')->default(0);
            $table->boolean('phone_no_verify')->default(0);
            $table->boolean('email_verify')->default(0);
            $table->rememberToken();
            $table->timestamps();
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
}
