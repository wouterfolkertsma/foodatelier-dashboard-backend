<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDashboardDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboard_data', function (Blueprint $table) {
            $table->foreignId('dashboard_id')
                ->constrained('dashboards')
                ->onDelete('cascade');

            $table->foreignId('data_id')
                ->constrained('data')
                ->onDelete('cascade');

            $table->primary(['dashboard_id', 'data_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dashboard_data');
    }
}
