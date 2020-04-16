<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('clients_id');
            $table->unsignedBigInteger('couriers_id')->nullable();
            $table->unsignedBigInteger('providers_id');
            $table->string('status');
            $table->string('food_arabian_id')->nullable();
            $table->string('food_chinese_id')->nullable();
            $table->string('food_burguer_id')->nullable();
            $table->string('food_pizza_id')->nullable();
            $table->string('food_chicken_id')->nullable();
            $table->string('food_korean_id')->nullable();
            $table->string('food_indian_id')->nullable();
            $table->string('food_italian_id')->nullable();
            $table->string('food_salads_id')->nullable();
            $table->string('food_vegetarian_id')->nullable();
            $table->string('food_vegans_id')->nullable();
            $table->string('food_traditional_id')->nullable();
            $table->string('food_japanese_id')->nullable();
            $table->string('food_mexican_id')->nullable();
            $table->string('extras_id')->nullable();
            $table->string('drinks_id')->nullable();
            $table->string('bakeries_id')->nullable();
            $table->string('liquor_store_id')->nullable();
            $table->string('victuals_id')->nullable();
            $table->string('delicatesse_id')->nullable();
            $table->string('fruit_store_id')->nullable();
            $table->string('greengrocer_id')->nullable();
            $table->string('fridge_id')->nullable();
            $table->string('lunch_id')->nullable();
            $table->string('typepayment_id');
            $table->timestamps();

            $table->foreign('clients_id')
            ->references('id')
            ->on('clients')
            ->onDelete('CASCADE');

            $table->foreign('couriers_id')
            ->references('id')
            ->on('couriers')
            ->onDelete('CASCADE');

            $table->foreign('providers_id')
            ->references('id')
            ->on('providers')
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
        Schema::dropIfExists('orders');
    }
}