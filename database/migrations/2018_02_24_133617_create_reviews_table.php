<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->text('review');
            $table->timestamp('review_date');

            $table->integer('rating')->default(0);

            $table->integer('order_id')->unsigned();
            $table->integer('cust_id')->unsigned();
            $table->integer('rest_id')->unsigned();

            $table->foreign('order_id')->references('id')->on('food_orders');
            $table->foreign('cust_id')->references('id')->on('customers');
            $table->foreign('rest_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
