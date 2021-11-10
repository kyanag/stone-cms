<?php


namespace App\Admin\Controllers;

use App\Admin\Models\ViewModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait QuickControllerTrait
{

    /**
     * @return ViewModel
     */
    abstract protected function getViewModel($id = null);


    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $viewModel = $this->getViewModel()
            ->withScenario("index")
            ->withInputs($request->input());

        return view("admin::common.index", [
            'model' => $viewModel,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $viewModel = $this->getViewModel()
            ->withScenario("create")
            ->withInputs($request->input());

        return view("admin::common.create", [
            'model' => $viewModel,
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
        $model = $this->getViewModel()
            ->withScenario("store")
            ->withInputs($request->input());

        if($model->persistOrFail()){
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
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $model = $this->getViewModel($id);

        return view("admin::common.show", [
            'model' => $model,
        ]);
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

        $viewModel = $viewModel->withScenario("edit")
            ->withInputs($request->input());

        return view("admin::common.create", [
            'model' => $viewModel,
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
        /** @var ViewModel $model */
        $model = $this->getViewModel($id);
        if(is_null($model)){
            throw new NotFoundHttpException("找不到的内容!");
        }
        $model = $this->getViewModel($id)
            ->withScenario("store")
            ->withInputs($request->input());

        try{
            if($model->persistOrFail()){
                return back()->with("success", "更新[{$model->showTitle()}] - {$model['title']} 成功!");
            }else{
                return back()->withInput()
                    ->withErrors("更新[{$model->showTitle()}] - {$model['title']} 失败!");
            }
        }catch (ValidationException $e){
            return back()->withInput()
                ->withErrors($e->errors())
                ->withErrors("更新[{$model->showTitle()}] - {$model['title']} 失败!");
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
        /** @var ViewModel|Model $model */
        $model = $this->getViewModel($id);
        if(is_null($model)){
            throw new NotFoundHttpException("找不到的内容!");
        }
        if($model->delete()){
            return "删除成功!";
        }else{
            throw new \Exception("删除失败!");
        }
    }

}
