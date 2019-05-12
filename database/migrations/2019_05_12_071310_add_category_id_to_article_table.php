<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryIdToArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('article', function (Blueprint $table) {
            $table->unsignedInteger('category_id')->comment('类别索引');
            $table->foreign('category_id')->references('id')->on('category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('article', function (Blueprint $table) {
            $table->dropColumn('category_id');
        });
    }
}
