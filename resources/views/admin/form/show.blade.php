<?php
/** @var \App\Admin\Models\FormView $model */

/** @var \Kyanag\Form\Interfaces\Renderer $renderer */
$renderer = app("renderer");
?>

@extends('admin::layouts.main')

@section('title', $model->showTitle())
@section("description", $model->showTitle())

@section('main')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">{{ $model->showTitle() }}</h1>
    </div>
    <h2><a href="">#{{ $model->title }}</a>  字段管理</h2>
    <div class="container-fluid pt-5">
        <div class="btn-toolbar mb-3" role="toolbar" aria-label="操作栏">
            <div class="btn-group mb-2 mr-2" role="group" aria-label="tool-group-main">
                <a type="button" class="btn btn-primary" >新增</a>
            </div>
            <div class="btn-group mb-2 mr-2" role="group" aria-label="tool-group-main">
                <div class="btn btn-outline-success">保存排序</div>
            </div>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">字段名</th>
                <th scope="col">字段title</th>
                <th scope="col">字段简介</th>
                <th scope="col">字段类型</th>
                <th scope="col">必填</th>
                <th scope="col">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($model->fields as $field)
            <tr>
                <th scope="row">1</th>
                <td>{{ $field['name'] }}</td>
                <td>{{ $field['title'] }}</td>
                <td>{{ $field['desc'] }}</td>
                <td>{{ $field['type'] }}</td>
                <td>{{ $field['is_required'] ? "√" : "" }}</td>
                <td>
                    <a href="">编辑</a>
                    <a href="">删除</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
