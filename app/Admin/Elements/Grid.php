<?php


namespace App\Admin\Elements;


use App\Admin\Interfaces\Renderable;
use Illuminate\Contracts\Pagination\Paginator;

class Grid implements Renderable
{

    protected $columns;

    protected $elements = [];

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

    public function getColumns()
    {
        return $this->columns;
    }

    public function getItems()
    {
        return $this->paginator->items();
    }

    public function getPerPage(){
        return $this->paginator->perPage();
    }

    public function getCurrentPage()
    {
        return $this->paginator->currentPage();
    }

    public function getTotalPage()
    {
        return $this->paginator->total();
    }

    public function render()
    {
        return view("admin::widgets.grid", [
            'grid' => $this,
        ]);
    }
}
