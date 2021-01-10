<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrendFilterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trend_filters', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('description');
            $table->string('search_term');
            $table->bigInteger('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->string('standard_interval');
            $table->date('custom_interval_from');
            $table->date('custom_interval_to');
            $table->string('language');
            $table->boolean('consider_web_search');
            $table->boolean('consider_image_search');
            $table->boolean('consider_news_search');
            $table->boolean('consider_youtube_search');
            $table->boolean('consider_shopping_search');
            $table->boolean('with_top_metric');
            $table->boolean('with_rising_metric');
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
        Schema::dropIfExists('data');
    }
}
