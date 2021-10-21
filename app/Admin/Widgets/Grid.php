<?php


namespace App\Admin\Widgets;


use App\Admin\Models\ViewModel;
use Kyanag\Form\Core\Widget;

class Grid extends Widget
{

    protected $columns;


    protected $links = [];

    /** @var ViewModel */
    protected $viewModel;


    public function __construct($type, $attributes = [], $columns = [])
    {
        parent::__construct($type, $attributes, []);
        $this->columns = $columns;
    }


    public function toForm(){
        return $this->viewModel->toGridForm();
    }

    public function getPaginator(){
        return $this->viewModel->getPaginator();
    }


    public function getLinkGroups(){
        return collect($this->links)->sortBy(function($link){
            return @$link['index'];
        })->groupBy(function($link){
            return @$link['group'];
        });
    }

    public function getColumns(){
        return $this->columns;
    }

    public function appendLink($link){
        $this->links[] = $link;
        return $this;
    }

    public function withLinks($links){
        $this->links = $links;
        return $this;
    }
}