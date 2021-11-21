<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatChat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create(
        //     'chat-msg',
        //     function (Blueprint $table) {
        //         $table->bigIncrements('id');
        //         $table->integer('item_id')->unsigned()
        //             ->comment('номер товара где чат');
        //         $table->text('msg')
        //             ->comment('сообщение');
        //         $table->integer('autor_id')->unsigned()
        //             ->comment('номер автора сообщения');
        //         $table->index(['item_id', 'autor_id']);
        //         $table->timestamps();
        //         $table->softDeletes();
        //     }
        // );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('chat-msg');
    }
}
