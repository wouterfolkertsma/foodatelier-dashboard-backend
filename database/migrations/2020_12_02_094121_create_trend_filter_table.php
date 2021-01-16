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
            $table->bigInteger('standard_interval_id')->unsigned()->default(2);
            $table->foreign('standard_interval_id')->references('id')->on('trend_filter_intervals');
            $table->date('custom_interval_from')->nullable($value = true);
            $table->date('custom_interval_to')->nullable($value = true);
            $table->string('language');
            $table->string('search_type')->default('Web-Search');
            $table->boolean('with_top_metric')->nullable($value = true);;
            $table->boolean('with_rising_metric')->nullable($value = true);
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
