<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id');
            $table->bigInteger('user_id');
            $table->text('no_shares_own');
            $table->string('country_list');
            $table->string('brokage_name')->nullable();
            $table->date('date_purchase')->nullable();
            $table->bigInteger('stock_verified')->default(0);
            $table->text('verified_string')->nullable();
            $table->boolean('admin_verify')->default(0);
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
        Schema::dropIfExists('stocks');
    }
}
