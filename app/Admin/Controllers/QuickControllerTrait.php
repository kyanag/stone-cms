<?php


namespace App\Admin\Controllers;


use App\Admin\ViewForms\Form;
use App\Admin\ViewGrids\Grid;
use App\Models\Admin\AdminMenu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait QuickControllerTrait
{

    abstract public function getModelClass();

    /**
     * @return Form
     */
    abstract public function getForm();

    /**
     * @return Grid
     */
    abstract public function getGrid();

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $grid = $this->getGrid();
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
        $form = $this->getForm()->toElement("", "POST");
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
        $model = new ($this->getModelClass())($attributes);
        if($model->save()){
            session()->flash("success", "保存成功!");
            return back();
        }else{
            session()->flash("error", "保存失败!");

        }
        return back();
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