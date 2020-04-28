<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersLiquorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers_liquor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('provider_id');
            $table->unsignedBigInteger('liquor_id');
            $table->timestamps();

            $table->foreign('provider_id')
            ->references('id')
            ->on('providers')
            ->onDelete('CASCADE');

            $table->foreign('liquor_id')
            ->references('id')
            ->on('liquor')
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
        Schema::dropIfExists('providers_liquor');
    }
}
