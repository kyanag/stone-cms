<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("cid")->comment("内容唯一编码");
            $table->string("title")->comment("栏目标题");
            $table->bigInteger("p_id")->comment("上级栏目")->default(0);
            $table->string("keywords")->nullable()->comment("关键字");
            $table->string("description")->nullable()->comment("简介");
            $table->string("bg_img")->nullable()->comment("背景图片");
            $table->string("jump_to")->nullable()->comment("跳转地址");
            $table->tinyInteger("status")->comment("状态 -1已删除 0正常 1不显示");
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
        Schema::dropIfExists('categories');
    }
}
