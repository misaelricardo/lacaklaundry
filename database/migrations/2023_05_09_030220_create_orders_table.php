<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customerName');
            $table->string('phoneNumber');
            $table->string('orderType');
            $table->integer('nominalOrder');
            $table->integer('orderWeight');
            $table->timestamp('orderDate')->default(now());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
