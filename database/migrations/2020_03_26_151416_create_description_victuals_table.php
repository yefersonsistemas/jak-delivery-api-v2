<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescriptionVictualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('description_victuals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description');            
            $table->unsignedBigInteger('providers_id');
            $table->unsignedBigInteger('victuals_id');
            $table->timestamps();

            $table->foreign('providers_id')
            ->references('id')
            ->on('providers')
            ->onDelete('CASCADE');
            
            $table->foreign('victuals_id')
            ->references('id')
            ->on('victuals')
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
        Schema::dropIfExists('description_victuals');
    }
}