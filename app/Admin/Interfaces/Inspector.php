<?php


namespace App\Admin\Interfaces;


use App\Admin\Widgets\Widget;

interface Inspector
{

    /**
     * @return Repository
     */
    public function getRepository();

    /**
     * @return Widget
     */
    public function getForm();

    /**
     * @return Widget
     */
    public function getGrid();

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return string
     */
    public function getDescription();
}
