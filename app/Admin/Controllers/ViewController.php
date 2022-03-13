<?php


namespace App\Admin\Controllers;


use App\Admin\Interfaces\ModelProxy;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class ViewController extends Controller
{

    /**
     * @return ModelProxy
     */
    abstract protected function getModelProxy();


    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $operator = $this->getModelProxy();

        return view("admin::common.index", [
            'operator' => $operator,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $operator = $this->getModelProxy();

        return view("admin::common.create", [
            'operator' => $operator,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        /** @var ModelProxy $proxy */
        $proxy = $this->getModelProxy();

        $inputs = $proxy->toForm()->submit($request->input());
        $proxy->fill($inputs);

        if($proxy->fill($inputs)->save()){
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
        $operator = $this->getModelProxy()
            ->withRecord($id);

        return view("admin::common.show", [
            'operator' => $operator,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $operator = $this->getModelProxy()
            ->withRecord($id);

        return view("admin::common.edit", [
            'operator' => $operator,
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
        $operator = $this->getModelProxy()
            ->withRecord($id);
        $inputs = $operator->toForm()->submit($request->input());


        $record = $operator->getRecord();
        if($record->fill($inputs)->save()){
            return back()->with("success", "[{$operator->showTitle()}] 更新成功!");
        }else{
            return back()
                ->withInput()
                ->with("danger", "[{$operator->showTitle()}] 更新失败!");
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
        $operator = $this->getModelProxy()
            ->withRecord($id);

        if($operator->asDeprecated()->flush()){
            return back()->with("success", "删除成功!");
        }else{
            return back()->with("danger", "删除失败!");
        }
    }

}
