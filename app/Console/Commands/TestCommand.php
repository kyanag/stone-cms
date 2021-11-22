<?php

namespace App\Console\Commands;

use App\Admin\Controllers\AdminUserController;
use App\Admin\Models\FormFieldView;
use App\Admin\Supports\Tree;
use App\Models\Category;
use App\Models\Content;
use App\Models\Form;
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
        /** @var FormFieldView $field */
        $field = FormFieldView::query()->first();
        $field->fireModelEvent("deleted");

            $columns = DB::connection()->getSchemaBuilder()->getColumnListing("c_articles");
            var_dump($columns);
    }
}
