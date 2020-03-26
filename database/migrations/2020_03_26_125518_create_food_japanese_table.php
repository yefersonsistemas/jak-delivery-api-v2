<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodJapaneseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_japanese', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->double('price_bs');
            $table->double('price_us')->nullable();
            $table->string('type');
            $table->unsignedBigInteger('providers_id');
            $table->timestamps();

            $table->foreign('providers_id')
            ->references('id')
            ->on('providers')
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
        Schema::dropIfExists('food_japenese');
    }
}