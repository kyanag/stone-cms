<?php


namespace App\Admin\Elements;


use App\Admin\Interfaces\Renderable;
use App\Admin\Elements\Grid\Column;
use Illuminate\Contracts\Pagination\Paginator;

class Grid implements Renderable
{
    /**
     * @var array<Column>
     */
    protected $columns;

    /**
     * @var array<Renderable>
     */
    protected $widgets = [];

    /**
     * @var Paginator
     */
    protected $paginator;

    public function __construct($columns)
    {
        $this->columns = $columns;
    }

    public function withPaginator(Paginator $paginator)
    {
        $this->paginator = $paginator;
        return $this;
    }

    public function hasWidget($name){
        return isset($this->widgets[$name]);
    }

    public function getWidget($name){
        return $this->widgets[$name];
    }

    public function getPaginator()
    {
        return $this->paginator;
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function getItems()
    {
        return $this->paginator->items();
    }

    public function render()
    {
        return view("admin::widgets.grid", [
            'grid' => $this,
        ]);
    }
}
