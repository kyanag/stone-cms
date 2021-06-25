<?php


namespace App\Admin\Widgets\Grids;


use App\Admin\Extendeds\BehaviourTrait;
use App\Admin\Widgets\Forms\GeneralForm;
use App\Admin\Widgets\Widget;
use Illuminate\Pagination\Paginator;

class GeneralGrid implements Widget
{

    use BehaviourTrait;

    public $columns;

    protected $links = [];

    /** @var Widget|GeneralForm */
    protected $filterForm;

    /**
     * @var Paginator
     */
    protected $paginator;


    public function withPaginator($paginator){
        $this->paginator = $paginator;
        return $this;
    }

    public function getPaginator(){
        return $this->paginator;
    }

    public function getItems(){
        return $this->paginator->items();
    }

    public function appendLink($link){
        $this->links[] = $link;
        return $this;
    }

    public function withLinks($links){
        $this->links = $links;
        return $this;
    }

    /**
     * 高级搜索表单
     * @param $form
     */
    public function withFilterForm($form){
        $this->filterForm = $form;
        return $this;
    }

    public function render()
    {
        return view("admin::widgets.general-grid", [
            'grid' => $this,
        ]);
    }


    public function linkGroups(){
        return collect($this->links)->sortBy(function($link){
            return @$link['index'];
        })->groupBy(function($link){
            return @$link['group'];
        });
    }

    public function columnsForSort(){
        return collect($this->columns)->filter(function($column){
            return @$column['sortable'];
        });
    }
}