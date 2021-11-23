<?php

namespace App\Console\Commands;

use App\Admin\Controllers\AdminUserController;
use App\Admin\Models\FormFieldView;
use App\Admin\Models\FormView;
use App\Admin\Supports\Tree;
use App\Models\Category;
use App\Models\Content;
use App\Models\Form;
use App\Models\FormField;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
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
        $this->h();
        exit();
        /** @var FormView $form */
        $form = FormView::query()->first();
        $form->load("fields");

        $json = $form->toJson();
        file_put_contents(database_path("data/form.json"), $json);
    }

    public function h(){
        DB::transaction(function(){
            $json = file_get_contents(database_path("data/form.json"));
            $result = json_decode($json, true);

            $fields = $result['fields'];
            unset($result['fields']);

            $model = (new Form($result));
            $model->save();

            $this->output->writeln($model->id);
            $fields = array_map(function($result){
                unset($result['rules'], $result['settings']);
                return new FormField($result);
            }, $fields);
            $model->fields()->saveMany($fields);
        });

    }
}
