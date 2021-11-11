<?php


namespace App\Admin\Controllers;

use App\Admin\Interfaces\ViewModelInterface;
use App\Admin\Models\ViewModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait QuickControllerTrait
{

    /**
     * @return ViewModelInterface
     */
    abstract protected function getModel($id = null);


    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $model = $this->getModel();

        return view("admin::common.index", [
            'model' => $model,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $model = $this->getModel();

        return view("admin::common.create", [
            'model' => $model,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        $model = $this->getModel();

        $inputs = $model->toForm()->submit($request->input());
        $model->inject($inputs);

        if($model->saveOrFail()){
            return back()->with("success", "保存成功!");
        }else{
            return back()->withInput()->with("danger", "保存失败!");
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
        $model = $this->getModel($id);

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
        $model = $this->getModel($id);
        if(is_null($model)){
            throw new NotFoundHttpException("找不到的内容!");
        }

        return view("admin::common.create", [
            'model' => $model,
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function update(Request $request, $id)
    {
        $model = $this->getModel($id);
        if(is_null($model)){
            throw new NotFoundHttpException("找不到的内容!");
        }

        $inputs = $model->toForm()->submit($request->input());
        $model->inject($inputs);

        if($model->saveOrFail()){
            return back()->with("success", "更新[{$model->showTitle()}] - {$model['title']} 成功!");
        }else{
            return back()
                ->withInput()
                ->with("danger", "更新[{$model->showTitle()}] - {$model['title']} 失败!");
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
        $model = $this->getModel($id);
        if(is_null($model)){
            throw new NotFoundHttpException("找不到的内容!");
        }
        if($model->delete()){
            return back()->with("success", "删除成功!");
        }else{
            return back()->with("danger", "删除失败!");
        }
    }

}
