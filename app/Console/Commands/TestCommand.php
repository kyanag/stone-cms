<?php

namespace App\Console\Commands;

use App\Admin\Supports\Tree;
use App\Models\Category;
use App\Models\Content;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
//        $category = new Category([
//            'title' => "内容",
//            'status' => 0,
//        ]);
//        if(!$category->saveOrFail()){
//            throw new \Exception(111);
//        }
        $content = Content::query()->first();
        $content->load([
            'contentable'
        ]);
        var_dump($content->toArray());

        $category = Category::query()->first();
        $category->load([
            'content'
        ]);
        var_dump($category->toArray());
    }
}
