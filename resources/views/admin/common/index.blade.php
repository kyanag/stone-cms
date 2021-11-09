<?php
/** @var \App\Admin\Models\ViewModel|\Illuminate\Database\Eloquent\Model $model */

$grid = $model->toGrid();

$currentController = request()->route()->getController();
$grid->withLinks([
    [
        'url' => action([get_class($currentController), "create"]),
        'title' => "新增",
        'type' => "primary",
    ]
]);
?>

@extends('admin::layouts.main')

@section('title', $model->showTitle())

@section('main')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">{{ $model->showTitle() }}</h1>
    </div>
    {{--    <h2>Section title</h2>--}}
    <div class="container-fluid">
        {!!
            app("renderer")->render($grid)
        !!}
    </div>
@endsection
