<?php


namespace App\Admin\Interfaces;


use App\Admin\Elements\ActiveForm;
use Illuminate\Database\Eloquent\Model;
use App\Admin\Elements\Grid;

/**
 * Interface ViewModelInterface
 * @package App\Admin\Interfaces
 */
interface ResourceOperator
{

    /**
     * @return string
     */
    public function showTitle();

    /**
     * @return string
     */
    public function showDescription();

    /**
     * @return ActiveForm
     */
    public function toForm();


    /**
     * @return Grid
     */
    public function toGrid();

    /**
     * 注入input内容
     * @param array $inputs
     * @return void
     */
    public function inject(array $inputs);


    /**
     * 注入实体数据
     * @param mixed $record
     * @return Model|array
     */
    public function withRecord($record);

    public function getRecord();
}
