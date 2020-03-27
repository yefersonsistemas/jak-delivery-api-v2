<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('couriers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type_vehicle', ['Moto', 'Automovil']);
            $table->Integer('bussiness_delivery');
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('address_id');
            $table->timestamps();

            $table->foreign('address_id')
            ->references('id')
            ->on('address')
            ->onDelete('CASCADE');

            $table->foreign('person_id')
            ->references('id')
            ->on('person')
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
        Schema::dropIfExists('couriers');
    }
}