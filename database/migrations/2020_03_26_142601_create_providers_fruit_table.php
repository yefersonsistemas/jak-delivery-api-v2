<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersFruitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers_fruit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('provider_id');
            $table->unsignedBigInteger('fruit_id');
            $table->timestamps();

            $table->foreign('provider_id')
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
        Schema::dropIfExists('providers_fruit');
    }
}