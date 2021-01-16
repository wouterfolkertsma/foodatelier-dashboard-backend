<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrendFilterIntervalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trend_filter_intervals', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('from')->default('now -31 days');
            $table->string('to')->default('now');
            $table->timestamps();
        });
    }


}
