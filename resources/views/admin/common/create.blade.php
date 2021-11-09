<?php
/** @var \App\Admin\Models\ViewModel|\Illuminate\Database\Eloquent\Model $model */
$currentController = request()->route()->getController();

$form = $model->toForm();
if($model->exists){
    $url = action([get_class($currentController), "update"], [$model->getKey()]);
    $form = $form->with($url, "PUT");
}else{
    $url = action([get_class($currentController), "store"]);
    $form = $form->with($url, "POST");
}

/** @var \Kyanag\Form\Interfaces\Renderer $renderer */
$renderer = app("renderer");
?>

@extends('admin::layouts.main')

@section('title', $model->showTitle())
@section("description", $model->showDescription())

@section('main')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">{{ $model->exists ? "修改" : "新增" }} {{ $model->showTitle() }}</h1>
    </div>
    {{--    <h2>Section title</h2>--}}
    <div class="container-fluid">
        {!!
            $renderer->render($form);
        !!}
    </div>
@endsection