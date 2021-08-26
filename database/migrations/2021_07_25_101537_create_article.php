<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("cid")->comment("内容唯一编码");
            $table->string("title")->comment("文章标题");
            $table->string("excerpt")->comment("摘要");
            $table->string("content")->comment("文章内容");
            $table->string("author_id")->comment("作者");
            $table->tinyInteger("status")->comment("-1删除，0正常 1隐藏");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
