<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDownloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('downloads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('title');
            $table->longText('seo_title')->nullable();
            $table->text('description')->nullable();
            $table->longText('author');
            $table->text('url');
            $table->integer('download_count')->nullable();
            //$table->timestamps();
            $table->integer('public')->nullable();
            $table->integer('created')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('downloads');
    }
}
