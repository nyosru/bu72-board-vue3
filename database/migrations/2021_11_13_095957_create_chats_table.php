<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vitrin-chats', function (Blueprint $table) {
            $table->id();

            $table->integer('room_id')->unsigned()
                ->comment('номер товара где чат');
            $table->text('msg')
                ->comment('сообщение');
            $table->integer('writer_id')->unsigned()
                ->comment('номер автора сообщения');
            $table->integer('to_user_id')->unsigned()
                ->comment('номер пользователя кому')
                ->nullable();
            $table->index(['room_id', 'writer_id']);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vitrin-chats');
    }
}
