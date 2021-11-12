<?php


namespace App\Admin\Controllers;


use App\Admin\Interfaces\ResourceOperator;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class ViewController extends Controller
{

    /**
     * @return ResourceOperator|Model
     */
    abstract protected function getResourceOperator();


    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $operator = $this->getResourceOperator();

        return view("admin::common.index", [
            'model' => $operator,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $operator = $this->getResourceOperator();

        return view("admin::common.create", [
            'model' => $operator,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        $operator = $this->getResourceOperator();

        $inputs = $operator->toForm()->submit($request->input());
        $operator->inject($inputs);

        if($operator->saveOrFail()){
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
        $operator = $this->getResourceOperator()
            ->withModel($id);

        return view("admin::common.show", [
            'model' => $operator,
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
        $operator = $this->getResourceOperator()
            ->withModel($id);

        return view("admin::common.create", [
            'model' => $operator,
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
        $operator = $this->getResourceOperator()
            ->withModel($id);

        $inputs = $operator->toForm()->submit($request->input());
        $operator->inject($inputs);

        if($operator->saveOrFail()){
            return back()->with("success", "更新[{$operator->showTitle()}] - {$operator['title']} 成功!");
        }else{
            return back()
                ->withInput()
                ->with("danger", "更新[{$operator->showTitle()}] - {$operator['title']} 失败!");
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
        $operator = $this->getResourceOperator()
            ->withModel($id);

        if($operator->delete()){
            return back()->with("success", "删除成功!");
        }else{
            return back()->with("danger", "删除失败!");
        }
    }

}