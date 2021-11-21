<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatCatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //  'name',
        //     'cat_id_up',
        //     'sort',
        //     'status'

        Schema::create('cats', function (Blueprint $table) {
            $table->id();

            // $table->integer('room_id')->unsigned()
            //     ->comment('номер товара где чат');

            $table->string('name')
            ->comment('название');

            $table->integer('cat_id_up')->unsigned()
                ->nullable()
                ->comment('номер верхнего каталога');

            $table->tinyInteger('sort')->unsigned()
                ->comment('сортировка')
                ->default(50)
                // ->nullable()
                ;

            $table->enum('status',['on','off'])->default('on');

            $table->index('cat_id_up');

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
        Schema::dropIfExists('cats');
    }
}
