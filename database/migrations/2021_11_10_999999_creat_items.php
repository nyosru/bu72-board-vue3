<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {

            $table->bigIncrements('id');
            // $table->bigIncrements('');

            // $table->integer('items_id')->unsigned()
            // ->comment('номер итема чья картинка');
            // $table->foreign('items_id')
            //     ->references('id')
            //     ->on('items')
            //     ->onDelete('cascade');

            $table->string('name',200)
                ->comment('название');

            $table->text('opis')
                ->nullable()
                ->comment('описание');

            $table->float('price',10,2)
                ->nullable()
                ->comment('цена');

            // $table->float('old_price', 10, 2)
            //     ->comment('старая цена');

            $table->date('date')
            ->comment('дата обьявления');

            $table->enum('status_order', ['buy','sell','free','arenda','arenda_search'])
            ->comment('тип обьявления');

            $table->integer('cat_id')->unsigned()
            ->comment('номер каталога где лежит обьявление');

            $table->integer('autor_id')->unsigned()
            ->comment('номер автора');

            // $table->boolean('first')->default(false)
            // ->comment('первая картинка или нет');

            $table->timestamps();
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
        Schema::dropIfExists('items');
    }
}
