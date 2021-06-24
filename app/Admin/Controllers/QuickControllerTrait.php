<?php


namespace App\Admin\Controllers;


use App\Admin\Interfaces\Repository;
use App\Admin\Widgets\Forms\GeneralForm;
use App\Admin\Widgets\Grids\GeneralGrid;
use App\Admin\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait QuickControllerTrait
{

    /**
     * @return Widget
     */
    abstract public function getForm();

    /**
     * @return Widget|GeneralGrid
     */
    abstract public function getGrid();

    /**
     * @return Repository
     */
    abstract public function getRepository();

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $grid = $this->getGrid();

        $grid->appendLink([
            'url' => action([static::class, "create"]),
            'title' => "新增",
            'type' => "primary",
        ]);
        $grid->withPaginator($this->getRepository()->paginator(10));

        return view("admin::common.index", [
            'grid' => $grid,
            'title' => "{$this->name} 列表",
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
     */
    public function store(Request $request)
    {
        $form = $this->getForm($request);
        $attributes = $form->extract($request);

        /** @var Model $model */
        $model = $this->getRepository()->newModel($attributes);
        if($model->save()){
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
     * @return \Illuminate\Http\Response
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
     */
    public function update(Request $request, $id)
    {
        /** @var Model $model */
        $model = $this->getRepository()->find($id);
        if(is_null($model)){
            throw new NotFoundHttpException("找不到的内容!");
        }
        /** @var GeneralForm $form */
        $form = $this->getForm();
        $attributes = $form->extract($request);

        $model->fill($attributes);
        if($model->saveOrFail()){
            return back()->with("success", "更新 [{$model['title']}] 成功!");
        }else{
            throw new \Exception("更新 [{$model['title']}] 失败!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /** @var Model $model */
        $model = $this->getRepository()->find($id);
        if(is_null($model)){
            throw new NotFoundHttpException("不存在的内容!");
        }
        if($model->delete()){
            return "删除成功!";
        }else{
            throw new \Exception("删除失败!");
        }
    }

}