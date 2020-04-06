<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type_dni', ['V', 'E', 'J']);
            $table->string('dni');
            $table->string('name');
            $table->string('lastname')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique()->nullable();
            $table->unsignedBigInteger('address_id');
            $table->timestamps();

            $table->foreign('address_id')
            ->references('id')
            ->on('address')
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
        Schema::dropIfExists('person');
    }
}