<?php


namespace App\Admin\Interfaces;


use App\Admin\Supports\ActiveForm;
use App\Admin\Widgets\Form;
use App\Admin\Widgets\Grid;
use Illuminate\Database\Eloquent\Model;
use Kyanag\Form\Core\Widget;

/**
 * Interface ViewModelInterface
 * @package App\Admin\Interfaces
 * @mixin Model
 */
interface ViewModelInterface
{

    /**
     * @return ActiveForm|Form
     */
    public function toForm();


    /**
     * @return Grid
     */
    public function toGrid();


    /**
     * @return Widget
     */
    public function toView();

    /**
     * 注入input内容
     * @param array $inputs
     * @return void
     */
    public function inject(array $inputs);
}