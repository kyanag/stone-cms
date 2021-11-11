<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name")->comment("表单名称");
            $table->string("title")->comment("表单标题");
            $table->string("desc")->comment("表单简介");
            $table->unsignedTinyInteger("count_fields")->comment("字段总数");
            $table->tinyInteger("status")->comment("0启用 1停用");
            $table->timestamps();

            $table->unique("name");
        });

        Schema::create("form_fields", function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedTinyInteger("form_id")->comment("所属表单！");
            $table->string("name")->comment("字段名称");
            $table->string("title")->comment("字段标题");
            $table->string("desc")->comment("字段简介");
            $table->string("type")->comment("字段类型");
            $table->string("settings")->comment("字段其他自定义属性");
            $table->boolean("is_required")->comment("是否必填");
            $table->string("rules")->default("")->comment("字段规则");
            $table->timestamps();

            $table->unique(["name", "form_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forms');
        Schema::dropIfExists("form_fields");
    }
}
