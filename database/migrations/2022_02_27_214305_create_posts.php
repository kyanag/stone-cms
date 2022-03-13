<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string('guid')->unique()->comment("唯一id");
            $table->integer("site_id")->default(0)->comment("站点id");
            $table->bigInteger("post_id")->comment("post id");
            $table->string("post_type", 20)->comment("post 类型");
            $table->string("post_title")->comment("标题");
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
        Schema::dropIfExists('posts');
    }
}
