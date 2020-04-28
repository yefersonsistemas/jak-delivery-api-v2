<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescriptionFruitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('description_fruit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description');            
            $table->unsignedBigInteger('providers_id');
            $table->unsignedBigInteger('fruit_id');
            $table->timestamps();

            $table->foreign('providers_id')
            ->references('id')
            ->on('providers')
            ->onDelete('CASCADE');
            
            $table->foreign('fruit_id')
            ->references('id')
            ->on('fruit')
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
        Schema::dropIfExists('description_fruit');
    }
}