<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescriptionJapaneseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('description_japanese', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description');            
            $table->unsignedBigInteger('providers_id');
            $table->unsignedBigInteger('japanese_id');
            $table->timestamps();

            $table->foreign('providers_id')
            ->references('id')
            ->on('providers')
            ->onDelete('CASCADE');
            
            $table->foreign('japanese_id')
            ->references('id')
            ->on('food_japanese')
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
        Schema::dropIfExists('description_japanese');
    }
}