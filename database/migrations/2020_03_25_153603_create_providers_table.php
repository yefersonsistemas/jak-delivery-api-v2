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
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->unsignedBigInteger('address_id');
            $table->unsignedBigInteger('typepayment_id');
            $table->unsignedBigInteger('branchoffice_id');
            $table->timestamps();

            $table->foreign('address_id')
            ->references('id')
            ->on('address')
            ->onDelete('CASCADE');

            $table->foreign('typepayment_id')
            ->references('id')
            ->on('typepayment')
            ->onDelete('CASCADE');

            $table->foreign('branchoffice_id')
            ->references('id')
            ->on('branchoffice')
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