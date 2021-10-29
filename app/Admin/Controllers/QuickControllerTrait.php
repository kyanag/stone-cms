<?php


namespace App\Admin\Controllers;


use App\Admin\Interfaces\Repository;
use App\Admin\Models\ViewModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait QuickControllerTrait
{

    /**
     * @return ViewModel
     */
    abstract protected function getViewModel($id = null);


    public function showEditTitle($viewModel){
        $title = $viewModel->showTitle();
        return $viewModel->exists ? "修改 {$title}" : "新增 {$title}";
    }


    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $viewModel = $this->getViewModel();
        $viewModel->fillForFilter($request->input() ?: []);

        $grid = $viewModel->toGrid()->withViewModel($viewModel);
        $grid->withLinks([
            [
                'url' => action([static::class, "create"]),
                'title' => "新增",
                'type' => "primary",
            ]
        ]);

        return view("admin::common.index", [
            'grid' => $grid,
            'title' => $viewModel->showTitle(),
            'description' => $viewModel->showDescription(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $viewModel = $this->getViewModel();
        $viewModel->fillForCreate($request->input() ?: []);
        $url = action([static::class, "store"]);

        $form = $viewModel->toForm()->with($url, "POST");

        return view("admin::common.create", [
            'form' => $form,
            'title' => $this->showEditTitle($viewModel),
            'description' => $viewModel->showDescription(),
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
    public function edit(Request $request, $id)
    {
        /** @var ViewModel $viewModel */
        $viewModel = $this->getViewModel($id);
        if(is_null($viewModel)){
            throw new NotFoundHttpException("找不到的内容!");
        }
        $form = $viewModel->toForm()
            ->with(action([static::class, "update"], [$id]), "PUT");

        return view("admin::common.create", [
            'form' => $form,
            'title' => $this->showEditTitle($viewModel),
            'description' => $viewModel->showDescription(),
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
