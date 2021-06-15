<?php

namespace App\Console\Commands;

use App\Admin\Supports\Tree;
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
        $badItems = [
            [
                'id' => 1,
                'p_id' => 0,
                'name' => "技术部",
            ],
            [
                'id' => 2,
                'p_id' => 1,
                'name' => "B项目组",
            ],
            [
                'id' => 3,
                'p_id' => 2,
                'name' => "B项目组 - CTO",

            ],

        ];
        $items = (new Tree($badItems))->toTreeList(collect());
        var_dump($items);
    }
}
