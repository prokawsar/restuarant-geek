<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->float('total_bill');
            $table->timestamp('order_date');
            $table->boolean('status')->default(0);
            $table->boolean('bill_paid')->default(0);
            $table->integer('cust_id')->unsigned();
            $table->integer('table_id')->unsigned();
            $table->integer('rest_id')->unsigned();

            $table->foreign('cust_id')->references('id')->on('customers');
            $table->foreign('table_id')->references('id')->on('tables');
            $table->foreign('rest_id')->references('id')->on('users');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_orders');
    }
}
