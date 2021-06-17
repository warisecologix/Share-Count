<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserStockLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_stock_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_ip',191)->nullable();
            $table->string('session_id',191)->nullable();
            $table->string('user_mac',191)->nullable();
            $table->string('location',191)->nullable();
            $table->string('browser',191)->nullable();
            $table->string('os',191)->nullable();
            $table->string('longitude',191)->nullable();
            $table->string('latitude',191)->nullable();
            $table->string('country',191)->nullable();
            $table->string('country_code',191)->nullable();
            $table->dateTime('save_time')->nullable();
            $table->string('machine_name',191)->nullable();
            $table->bigInteger('stock_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('company_id')->nullable();
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
        Schema::dropIfExists('user_login_logs');
    }
}
