<?php


namespace App\Admin\Interfaces;


use App\Admin\Elements\ActiveForm;
use Illuminate\Database\Eloquent\Model;
use App\Admin\Elements\Grid;

/**
 * Interface ViewModelInterface
 * @package App\Admin\Interfaces
 */
interface ModelProxy
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
     * @param array $attributes
     * @return self
     */
    public function fill(array $attributes);

    /**
     * 注入实体数据
     * @param mixed $record
     * @return self
     */
    public function withRecord($record);


    /**
     * @return Model
     */
    public function getRecord();


    /**
     * @return bool
     */
    public function save();

    /**
     * @return bool
     */
    public function delete();
}
