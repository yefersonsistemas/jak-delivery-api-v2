<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssigmentOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assigment_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('orders_id');
            $table->unsignedBigInteger('couriers_id');


            $table->foreign('orders_id')
            ->references('id')
            ->on('orders')
            ->onDelete('CASCADE');

            $table->foreign('couriers_id')
            ->references('id')
            ->on('couriers')
            ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assigment_order');
    }
}