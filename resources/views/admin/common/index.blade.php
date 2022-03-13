<?php
/** @var \App\Admin\Interfaces\ModelProxy $operator */

$grid = $operator->toGrid();
?>

@extends('admin::layouts.main')

@section('title', $operator->showTitle())

@section('main')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">{{ $operator->showTitle() }}</h1>
    </div>
    <div class="container-fluid">
        {!!
            $operator->toGrid()->render();
        !!}
    </div>
@endsection
