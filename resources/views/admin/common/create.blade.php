<?php
/** @var \App\Admin\Interfaces\ResourceOperator | \App\Admin\Models\ViewModel $model */
$currentController = request()->route()->getController();

$form = $model->toForm()->withValue(request()->input());
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
    <div>
        @if(session()->has("errors"))
            <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">错误!</h4>
                @foreach(session()->get("errors")->all() as $message)
                    <p>{{ $message }}</p>
                @endforeach
            </div>
        @endif
    </div>
    {{--    <h2>Section title</h2>--}}
    <div class="container-fluid">
        {!!
            $renderer->render($form);
        !!}
    </div>
@endsection