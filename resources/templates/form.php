<?php
/** @var \App\Types\FormElement $element */
/** @var \League\Plates\Template\Template $this */
?>
<form <?=\Kyanag\Form\renderAttributes([
    'id' => $this->e($element->id),
    'class' => $this->e($element->class),
    'style' => $this->e($element->style),
    'action' => $this->e($element->action),
    'enctype' => $this->e($element->enctype),
    'method' => in_array(strtoupper($element->method), ['GET', 'POST']) ? $element->method : "POST",
])?>>
    <?=csrf_field()?>
    <?php foreach($element->children as $child){
        app("renderer")->render($child);
    } ?>
    <div class="form-group row">
        <div class="col-md-2"><?=$this->e($element->label)?></div>
        <div class="col-md-10">
            <button class="btn btn-primary" type="submit">保存</button>
            <button class="btn btn-warning" type="reset">重置</button>
        </div>
    </div>
</form>

