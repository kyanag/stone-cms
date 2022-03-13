<?php


namespace App\Admin\Elements;


use App\Admin\Interfaces\Renderable;
use Illuminate\Support\Arr;

class Toolbar implements Renderable
{
    /**
     * type, url, title, children
     * @var array[]
     */
    protected $links = [];

    public static function create($links)
    {
        if(!Arr::isAssoc($links)){
            $links = [
                'default' => $links,
            ];
        }
        $toolbar = new static();
        $toolbar->links = $links;
        return $toolbar;
    }

    public function getLinks($topic = "default")
    {
        return isset($this->links[$topic]) ? $this->links[$topic] : [];
    }

    public function withLinks($links, $topic = "default")
    {
        $this->links[$topic] = $links;
        return $this;
    }

    public function render()
    {
        return view("admin.widgets.toolbar", [
            'toolbar' => $this,
        ]);
    }
}
