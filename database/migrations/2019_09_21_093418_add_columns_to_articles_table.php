<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToArticlesTable extends Migration
{
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->integer('likes_count')->default(0);
        });
    }
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            //
        });
    }
}
