<?php

namespace App\Console\Commands;

use App\Admin\Supports\Tree;
use App\Models\Category;
use App\Models\Content;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

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
        $rules = ['name' => 'password'];

        $input = ['name' => null];

        $validator = Validator::make($input, $rules);
        $a = !$validator->fails();
        var_dump($validator->errors());exit();

        $cases = [
            [
                'str' => "abcd",
                'value' => false,
            ],
            [
                'str' => "abcdef.",
                'value' => false,
            ],
            [
                'str' => ".abcdef",
                'value' => false,
            ],
            [
                'str' => "abcdef_32.nam",
                'value' => true,
            ]
        ];
        foreach ($cases as $case){
            $v = preg_match("/^[a-zA-Z][a-zA-Z0-9_\.]{4,18}[a-zA-Z0-9]$/", $case['str']);

            var_dump($v);

            $success = $v == $case['value'] ? "[success]" : "[fail   ]";
            echo "{$success} 【{$case['str']}】\n";
        }
    }
}
