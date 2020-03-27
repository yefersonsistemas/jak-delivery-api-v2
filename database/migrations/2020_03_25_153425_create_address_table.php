<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('states_id');
            $table->unsignedBigInteger('cities_id');
            $table->unsignedBigInteger('municipalities_id');
            $table->unsignedBigInteger('parishes_id');
            // $table->unsignedBigInteger('branchoffice_id');
            $table->string('address');
            $table->timestamps();

            $table->foreign('states_id')
            ->references('id')
            ->on('states')
            ->onDelete('CASCADE');
        
            $table->foreign('cities_id')
            ->references('id')
            ->on('cities')
            ->onDelete('CASCADE');
        
            $table->foreign('municipalities_id')
            ->references('id')
            ->on('municipalities')
            ->onDelete('CASCADE');
            
            $table->foreign('parishes_id')
            ->references('id')
            ->on('parishes')
            ->onDelete('CASCADE');

            // $table->foreign('branchoffice_id')
            // ->references('id')
            // ->on('branchoffice')
            // ->onDelete('CASCADE');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address');
    }
}