<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescriptionSaladsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('description_salads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description');            
            $table->unsignedBigInteger('providers_id');
            $table->unsignedBigInteger('salads_id');
            $table->timestamps();

            $table->foreign('providers_id')
            ->references('id')
            ->on('providers')
            ->onDelete('CASCADE');
            
            $table->foreign('salads_id')
            ->references('id')
            ->on('food_salads')
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
        Schema::dropIfExists('description_salads');
    }
}