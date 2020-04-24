<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFridgeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fridge', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->double('price_bs');
            $table->double('price_us')->nullable();
            $table->string('type'); //guarda el tipo de comida elegida
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
        Schema::dropIfExists('fridge');
    }
}