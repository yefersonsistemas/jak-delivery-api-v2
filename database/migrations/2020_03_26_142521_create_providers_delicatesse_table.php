<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersDelicatesseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers_delicatesse', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('providers_id');
            $table->unsignedBigInteger('delicatesse_id');
            $table->timestamps();

            $table->foreign('providers_id')
            ->references('id')
            ->on('providers')
            ->onDelete('CASCADE');

            $table->foreign('delicatesse_id')
            ->references('id')
            ->on('delicatesse')
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
        Schema::dropIfExists('providers_delicatesse');
    }
}