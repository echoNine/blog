<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->comment('用户id');
            $table->foreign('user_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
