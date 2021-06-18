<?php


namespace App\Admin\Widgets\Grids;


use App\Admin\Widgets\Widget;

class GeneralGrid extends Widget
{

    public function render()
    {
        return view("admin::widgets.general-grid", [
            'grid' => $this,
        ]);
    }

}