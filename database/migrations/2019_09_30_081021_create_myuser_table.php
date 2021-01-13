<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyuserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('myuser', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->text('user_address');
            $table->integer('user_created_date');
            $table->text('user_email');
            $table->text('user_full_name');
            $table->integer('user_last_logged');
            $table->text('user_login');
            $table->text('user_password');
            $table->text('user_password_salt');
            $table->text('user_phone');
            $table->text('user_role');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('myuser');
    }
}
