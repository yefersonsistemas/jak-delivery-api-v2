<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecurityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('security', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('person_id');
            // $table->string('question');
            // $table->string('answers');
            $table->string('question_1');
            $table->string('answers_1');
            $table->string('question_2');
            $table->string('answers_2');
            $table->string('question_3');
            $table->string('answers_3');
            $table->timestamps();

        $table->foreign('person_id')
            ->references('id')
            ->on('person')
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
        Schema::dropIfExists('security');
    }
}
