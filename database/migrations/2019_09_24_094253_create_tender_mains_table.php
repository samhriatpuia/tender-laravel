<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenderMainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tender_mains', function (Blueprint $table) {
            $table->increments('id');
            $table->text('tender_number');
            $table->integer('issue_date');
            $table->integer('last_date_of_submission');
            $table->integer('opening_date');
            $table->text('department');
            $table->text('subject');
            $table->longtext('detail');
            $table->integer('author');
            $table->string('attachment')->nullable();
            $table->integer('created')->nullable();
            $table->integer('modified')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tender_mains');
    }
}
