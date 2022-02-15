<?php


namespace App\Admin\Widgets;


use App\Admin\Interfaces\Renderable;

class Toolbar implements Renderable
{

    const LINK_GROUP_SORT = "sort";

    protected $links;

    public function __construct($buttons = [])
    {
        $this->links = $buttons;
    }

    public function getLinkGroups(){
        return collect($this->links)->groupBy(function($link){
            return @$link['group'];
        });
    }

    public function getLinks($group = null){
        return collect($this->links)->filter(function($link) use($group){
            if($group === null){
                return true;
            }
            return $link['group'] == $group;
        })->map(function($link){
            return $link['link'];
        });
    }

    public function render()
    {
        return view("admin::widgets.toolbar", [
            'toolbar' => $this,
        ]);
    }
}
