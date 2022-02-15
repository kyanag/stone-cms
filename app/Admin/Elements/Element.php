<?php


namespace App\Admin\Elements;


use App\Admin\Interfaces\Renderable;

class Element extends AbstractElement implements Renderable
{


    public function render()
    {
        return app("renderer")->render($this);
    }
}
