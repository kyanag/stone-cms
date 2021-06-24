<?php
/** @var \App\Admin\Widgets\Forms\GeneralForm $form */
?>
<form {!! \Kyanag\Form\renderAttributes([
    'id' => e($form->id),
    'class' => e($form->class),
    'style' => e($form->style),
    'action' => e($form->action),
    'enctype' => e($form->enctype),
    'method' => in_array(strtoupper($form->method), ['GET', 'POST']) ? $form->method : "POST",
]) !!}>
    <?=csrf_field()?>
    <?=method_field($form->method)?>
    @foreach($form->fields as $field)
        {!! app("renderer")->render($field) !!}
    @endforeach
    <div class="form-group row">
        <div class="col-md-2">{{ $form->label }}</div>
        <div class="col-md-10">
            <button class="btn btn-primary" type="submit">保存</button>
            <button class="btn btn-warning" type="reset">重置</button>
        </div>
    </div>
</form>

