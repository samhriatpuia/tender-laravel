<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenderDepartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tender_department', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('name', 250);
            $table->char('color', 10);
            $table->integer('parent');
            $table->integer('user_id');
            $table->integer('created');
            $table->integer('updated');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tender_department');
    }
}
