<?php


namespace App\Admin\Interfaces;


use App\Admin\Elements\ActiveForm;
use App\Admin\Elements\Form\Form;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface ViewModelInterface
 * @package App\Admin\Interfaces
 * @mixin Model
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
     * @return ActiveForm|Form
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
     * @param $pk
     * @return self
     */
    public function withRecord($record);
}
