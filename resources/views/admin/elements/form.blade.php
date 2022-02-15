<?php
/** @var \App\Admin\Elements\ActiveForm $element */
?>
<form
<?=\Kyanag\Form\renderAttributes([
    'id' => e($element->getId()),
    'class' => e($element->getClass()),
    'style' => e($element->getStyle()),
    'action' => e($element->getAction()),
    'enctype' => e($element->getEnctype()),
    'method' => $element->getMethod(),
]) ?>
>
    <?=csrf_field()?>
    <?=method_field($element->getMethod(true))?>
    <?php foreach($element->getChildren() as $child){ ?>
        <?=$child->render();?>
    <?php } ?>
    <div class="form-group row">
        <div class="col-md-2"></div>
        <div class="col-md-10">
            <button class="btn btn-primary" type="submit"><?=$element->getSubmitText()?></button>
            <button class="btn btn-warning" type="reset"><?=$element->getResetText()?></button>
        </div>
    </div>
</form>
