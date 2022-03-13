<?php


namespace App\Admin;


use App\Admin\Supports\ResourceManager;
use App\Models\Option;

class Admin
{

    /**
     * @return ResourceManager
     */
    public static function resources()
    {
        return app(ResourceManager::class);
    }

    public static function resource($id)
    {
        return static::resources()[$id];
    }

    public static function menus()
    {
        return [
            [
                'title' => "首页",
                'url' => route("admin.home"),
            ],
            [
                'title' => "管理员",
                'url' => route("admin.user.index")
            ],
            [
                'title' => "文章",
                'url' => route("admin.article.index")
            ],
            [
                'title' => "内容",
                'url' => route("admin.post.index")
            ],
            [
                'title' => "系统设置",
                'url' => route("admin.config.view")
            ]
        ];
    }

    public static function opts()
    {
        $opts = Option::query()->pluck("value", "key");
        return $opts;
    }
}
