<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserHasMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_messages', function (Blueprint $table) {
            $table->foreignId('user_id_from')
                ->constrained('users')
                ->onDelete('restrict');

            $table->foreignId('user_id_to')
                ->constrained('users')
                ->onDelete('restrict');

            $table->foreignId('message_id')
                ->constrained('messages')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
