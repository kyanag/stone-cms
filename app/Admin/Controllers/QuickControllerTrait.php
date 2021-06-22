<?php


namespace App\Admin\Controllers;


use App\Admin\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait QuickControllerTrait
{

    /**
     * @return Widget
     */
    abstract public function getForm(Request $request);

    /**
     * @return Widget
     */
    abstract public function getGrid(Request $request);

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $grid = $this->getGrid($request);
        return view("admin::common.index", [
            'grid' => $grid,
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
        $form = $this->getForm($request)->with($url, "POST");
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
        $model = new $this->modelClass;
        $model->fill($attributes);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}