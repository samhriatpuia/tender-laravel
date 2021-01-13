<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConstraintToTenderMains extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tender_mains', function (Blueprint $table) {
            $table->float('issue_date')->change();
            $table->float('last_date_of_submission')->change();
            $table->float('opening_date')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tender_mains', function (Blueprint $table) {
            $table->integer('issue_date')->change();
            $table->integer('last_date_of_submission')->change();
            $table->integer('opening_date')->change();
        });
    }
}
