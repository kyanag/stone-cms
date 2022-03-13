<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticles extends Migration
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
            $table->string('guid')->unique()->comment("唯一id");
            $table->integer("site_id")->default(0)->comment("站点id");
            $table->string("title")->comment("文章标题");
            $table->string("desc")->comment("简介");
            $table->tinyInteger("content_type")->default(0)->comment("文章类型 0 markdown 1 富文本 2文档");
            $table->longText("content")->comment("文章内容");

            $table->tinyInteger("status")->default(0)->comment("0正常 1待审核 99隐藏");
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
        Schema::dropIfExists('articles');
    }
}
