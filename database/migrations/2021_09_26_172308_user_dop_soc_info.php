<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserDopSocInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('socset', 50)->nullable();
            $table->string('socset_id', 50)->nullable();
            $table->string('avatar', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // удалим столбец
            $table->dropColumn('socset');
            $table->dropColumn('socset_id');
            $table->dropColumn('avatar');
        });
    }
}
