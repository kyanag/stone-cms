<?php
/** @var \App\Admin\Models\ViewModel $model */

/** @var \Kyanag\Form\Interfaces\Renderer $renderer */
$renderer = app("renderer");
?>

@extends('admin::layouts.main')

@section('title', $title)
@section("description", $description)

@section('main')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">{{ $title }}</h1>
    </div>
    {{--    <h2>Section title</h2>--}}
    <div class="container-fluid">
        {!!
            $renderer->render($form);
        !!}
    </div>
@endsection