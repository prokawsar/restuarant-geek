<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('owner_name');
            $table->string('rest_name');
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('address')->nullable();
            $table->string('closing_day')->nullable();
            $table->string('image')->default('no-image.jpg');
            $table->boolean('verified')->default(0);
            $table->string('email_token')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
