<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type_dni', ['V', 'E', 'J']);
            $table->string('dni');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('price_delivery');
            $table->unsignedBigInteger('address_id');
            $table->unsignedBigInteger('typepayment_id');
            $table->timestamps();

            $table->foreign('address_id')
            ->references('id')
            ->on('address')
            ->onDelete('CASCADE');

            $table->foreign('typepayment_id')
            ->references('id')
            ->on('typepayment')
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
        Schema::dropIfExists('providers');
    }
}