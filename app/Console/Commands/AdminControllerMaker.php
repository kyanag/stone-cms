<?php

namespace App\Console\Commands;

use App\Admin\Controllers\ViewController;
use App\Admin\Interfaces\ResourceOperator;
use App\Admin\Models\FormView;
use Composer\Autoload\ClassLoader;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

class AdminControllerMaker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:controller {controller} {--vmClass=} {--override}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Admin ViewModelController';


    protected $namespace = "App\\Admin\\Controllers\\";

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
        $controller = $this->generateController();
        $vmClass = $this->option("vmClass");

        if(!class_exists($vmClass)){
            $this->output->error("不存在的视图模型");
            exit();
        }

        $override = $this->option("override");
        $filename = $this->getClassFilename($controller);
        if(!$override && file_exists($filename)){
            $this->output->error("目标文件已存在！");
            exit();
        }
        if($filename){
            $code = $this->generateCode($controller, $vmClass);
            file_put_contents($filename, $code);
        }
        if(file_exists($filename)){
            $this->output->success("{$controller} generated");
        }else{
            $this->output->error("{$controller} generate failed!");
            exit();
        }
        return 0;
    }

    protected function generateCode($controller, $vmClass){
        $controllerBaseclass = class_basename($controller);
        $vmBaseclass = class_basename($vmClass);
        $tpl = <<<EOF
<?php
namespace App\Admin\Controllers;

use App\Admin\Interfaces\ResourceOperator;
use Illuminate\Database\Eloquent\Model;
use {$vmClass};

class {$controllerBaseclass} extends ViewController
{

    /**
     * @var ResourceOperator|Model
     */
    protected \$operator;

    /**
     * FormFieldController constructor.
     * @param ResourceOperator \$operator
     */
    public function __construct({$vmBaseclass} \$operator)
    {
        \$this->operator = \$operator;
    }


    protected function getResourceOperator()
    {
        return \$this->operator;
    }

}
EOF;
        return $tpl;
    }

    protected function generateController(){
        $controller = $this->argument("controller");
        return "{$this->namespace}{$controller}";
    }

    protected function getClassFilename($class){
        if(substr($class, 0, 3) == "App"){
            $filename = base_path(lcfirst($class)) . ".php";
            return $filename;
        }
        return null;
    }
}
