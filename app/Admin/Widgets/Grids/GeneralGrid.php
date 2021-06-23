<?php


namespace App\Admin\Widgets\Grids;


use App\Admin\Widgets\Widget;
use Illuminate\Pagination\Paginator;

class GeneralGrid implements Widget
{

    public $columns;

    protected $items = [];

    protected $links = [];

    /** @var Widget */
    protected $advancedSearch;

    protected $paginator;

    /**
     * @param $items
     * @param Paginator|null $paginator
     */
    public function withItems($items, $paginator = null){
        $this->items = $items;
        $this->paginator = $paginator;
        return $this;
    }

    public function withLink($link){
        $this->links[] = $link;
        return $this;
    }

    public function coverLinks($links){
        $this->links = $links;
    }

    /**
     * 高级搜索表单
     * @param $form
     */
    public function withAdvancedSearch($form){
        $this->advancedSearch = $form;
    }

    public function render()
    {
        return view("admin::widgets.general-grid", [
            'grid' => $this,
        ]);
    }

}