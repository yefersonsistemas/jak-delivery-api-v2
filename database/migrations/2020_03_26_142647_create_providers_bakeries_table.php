<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersBakeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers_bakeries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('provider_id');
            $table->unsignedBigInteger('bakery_id');
            $table->timestamps();

            $table->foreign('provider_id')
            ->references('id')
            ->on('providers')
            ->onDelete('CASCADE');

            $table->foreign('bakery_id')
            ->references('id')
            ->on('bakeries')
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
        Schema::dropIfExists('providers_bakeries');
    }
}
