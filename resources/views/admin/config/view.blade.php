<?php
/** @var \App\Admin\Elements\ActiveForm $form */
?>

@extends('admin::layouts.main')

@section('main')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">系统设置</h1>
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
            $form->render();
        !!}
    </div>
@endsection
