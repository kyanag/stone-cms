<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("username")->comment("账号");
            $table->string("nickname")->comment("昵称");
            $table->string("password")->comment("密码");
            $table->tinyInteger("status")->comment("0正常 1禁用");
            $table->timestamps();
        });

        $admin_user = new \App\Models\AdminUser([
            'username' => "admin",
            'nickname' => "Admin",
            'password' => \Illuminate\Support\Facades\Hash::make("123456"),
            'status' => 0,
        ]);
        $admin_user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_users');
    }
}
