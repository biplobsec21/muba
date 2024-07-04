<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_content', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cat_id')->unsigned();
            $table->string('icon');
            $table->string('jpg_name');
            $table->string('png_name');
            $table->boolean('status')->default(false);
            $table->foreign('cat_id')->references('id')->on('tbl_category')->onDelete('cascade');
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
        Schema::create('tbl_content', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cat_id')->unsigned();
            $table->string('icon');
            $table->string('jpg_name');
            $table->string('png_name');
            $table->boolean('status')->default(false);
            $table->foreign('cat_id')->references('id')->on('tbl_category')->onDelete('cascade');
            $table->timestamps();
        });
    }
}
