<?php


namespace App\Admin\ViewGrids;


use App\Admin\Types\TypeGridColumn;
use App\Admin\ViewForms\Form;
use Kyanag\Form\Interfaces\Element;

abstract class Grid
{
    /**
     * @param $scene
     * @return array<TypeGridColumn>
     */
    abstract public function getColumns();

    /**
     * @return Form
     */
    abstract public function getSearchForm();


    public function resolveQueryBuilder(){
        
    }
}