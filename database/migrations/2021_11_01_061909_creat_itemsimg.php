<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatItemsimg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items-img', function (Blueprint $table) {

            $table->bigIncrements('id');
            // $table->bigIncrements('');

            $table->integer('items_id')->unsigned()
            ->comment('номер итема чья картинка');
            // $table->foreign('items_id')
            //     ->references('id')
            //     ->on('items')
            //     ->onDelete('cascade');

            $table->string('img')
                ->comment('ссылка на файл');

            $table->boolean('first')->default(false)
            ->comment('первая картинка или нет');

            $table->softDeletes();

            // $table->longText('payload');
            // $table->unsignedTinyInteger('attempts');
            // $table->unsignedInteger('reserved_at')->nullable();
            // $table->unsignedInteger('available_at');
            // $table->unsignedInteger('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items-img');
    }
}
