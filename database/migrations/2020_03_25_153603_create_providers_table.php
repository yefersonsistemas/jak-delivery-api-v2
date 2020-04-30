<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('person_id');
            $table->string('price_delivery');
            $table->unsignedBigInteger('typepayment_id');
            $table->string('schedule_id');
            $table->timestamps();

            $table->foreign('person_id')
            ->references('id')
            ->on('person')
            ->onDelete('CASCADE');

            $table->foreign('typepayment_id')
            ->references('id')
            ->on('typepayment')
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
        Schema::dropIfExists('providers');
    }
}