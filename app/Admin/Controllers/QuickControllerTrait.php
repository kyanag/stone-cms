<?php


namespace App\Admin\Controllers;


use App\Admin\Interfaces\Repository;
use App\Admin\Supports\ModelRepository;
use App\Admin\Widgets\Forms\GeneralForm;
use App\Admin\Widgets\Grids\GeneralGrid;
use App\Admin\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait QuickControllerTrait
{

    /**
     * @return Widget
     */
    abstract public function getForm(Model $model = null);

    /**
     * @return Widget|GeneralGrid
     */
    abstract public function getGrid();

    /**
     * @return Repository|ModelRepository
     */
    abstract public function getRepository();

    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $grid = $this->getGrid();
        $attributes = $grid->triggerBehaviour("search", $request);
        $paginator = $this->getRepository()->paginate("", $attributes);
        $grid->withPaginator($paginator);
        return view("admin::common.index", [
            'grid' => $grid,
            'title' => "{$this->name} 列表",
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $url = action([static::class, "store"]);
        $form = $this->getForm()->with($url, "POST");
        return view("admin::common.create", [
            'form' => $form,
            'title' => "新增 - {$this->name}",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $form = $this->getForm();

        $attributes = $form->triggerBehaviour("submit", $request);

        $model = $this->getRepository()->create($attributes);
        if($model !== false){
            session()->flash("success", "保存成功!");
            return back();
        }else{
            return back()->withInput()
                ->withErrors("保存失败!");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        /** @var Model $model */
        $model = $this->getRepository()->find($id);
        if(is_null($model)){
            throw new NotFoundHttpException("找不到的内容!");
        }
        /** @var GeneralForm $form */
        $form = $this->getForm()->with(action([static::class, "update"], [$id]), "PUT");
        $form->setValue($model->toArray());

        return view("admin::common.create", [
            'controller' => $this,
            'form' => $form,
            'title' => "修改{$this->name} - [{$model['title']}]",
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function update(Request $request, $id)
    {
        $model = $this->getRepository()->find($id);
        if(is_null($model)){
            throw new NotFoundHttpException("找不到的内容!");
        }
        /** @var GeneralForm $form */
        $form = $this->getForm();
        $attributes = $form->triggerBehaviour("submit", $request);

        if($this->getRepository()->update($model, $attributes)){
            return back()->with("success", "更新[{$this->name}] - {$model['title']} 成功!");
        }else{
            throw new \Exception("更新[{$this->name}] - {$model['title']} 成功!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        if($this->getRepository()->delete($id)){
            return "删除成功!";
        }else{
            throw new \Exception("删除失败!");
        }
    }

}
