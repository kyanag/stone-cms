<?php
/** @var \App\Admin\Widgets\Form $widget */
/** @var \Kyanag\Form\Interfaces\Renderer $renderer */
$renderer = app("renderer");
?>
<form
<?=\Kyanag\Form\renderAttributes([
    'id' => e($widget->getId()),
    'class' => e($widget->getClass()),
    'style' => e($widget->getStyle()),
    'action' => e($widget->getAction()),
    'enctype' => e($widget->getEnctype()),
    'method' => in_array(strtoupper($widget->getMethod()), ['GET', 'POST']) ? $widget->getMethod() : "POST",
]) ?>
>
    <?=csrf_field()?>
    <?=method_field($widget->getMethod())?>
    <?php foreach($widget->getChildren() as $child){ ?>
        <?=$renderer->render($child);?>
    <?php } ?>
    <div class="form-group row">
        <div class="col-md-2"></div>
        <div class="col-md-10">
            <button class="btn btn-primary" type="submit"><?=$widget->getSubmitText()?></button>
            <button class="btn btn-warning" type="reset"><?=$widget->getResetText()?></button>
        </div>
    </div>
</form>