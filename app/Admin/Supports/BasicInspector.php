<?php


namespace App\Admin\Supports;


use App\Admin\Interfaces\Inspector;

class BasicInspector implements Inspector
{

    protected $repository;

    protected $columns = [];

    protected $title;

    protected $description;

    protected $form;

    protected $grid;

    public function __construct($modelClass, $columns = [], $title = "", $description = "")
    {
        $this->repository = new ModelRepository(new $modelClass);
        $this->columns = $columns;
        $this->title = $title;
        $this->description = $description;

        $this->form = Factory::makeViewForm([
            'fields' => [],
        ]);
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getForm()
    {
        // TODO: Implement getForm() method.
    }

    public function getGrid()
    {
        // TODO: Implement getGrid() method.
    }

    public function getRepository()
    {
        return $this->repository;
    }

}
