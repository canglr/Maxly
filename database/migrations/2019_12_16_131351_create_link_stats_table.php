<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinkStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_stats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('links_id')->unsigned();
            $table->foreign('links_id')->references('id')->on('links');
            $table->string('ip_address');
            $table->string('browser');
            $table->string('language');
            $table->string('referer');
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
        Schema::dropIfExists('link_stats');
    }
}
