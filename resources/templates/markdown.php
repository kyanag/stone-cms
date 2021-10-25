<?php
/** @var \Kyanag\Form\Core\Widget $widget */
/** @var \League\Plates\Template\Template $this */
?>
<div class="form-group row">
    <label class="col-md-2 col-form-label" for="<?=$this->e($widget->getId())?>"><?=$this->e($widget->getLabel())?></label>
    <div class="col-md-10">
        <textarea
            name="<?=$this->e($widget->name)?>"
            class="form-control <?=$this->e($widget->class)?>"
            <?=\Kyanag\Form\renderAttributes([
                'rows' => intval(@$widget->rows ?: 3),
                'id' => $this->e($widget->id),
                'readonly' => boolval($widget->readonly),
                'disabled' => boolval($widget->disabled),
                'placeholder' => $this->e($widget->placeholder),
                'style' => $this->e($widget->style)
            ])?>
        ><?=$this->e($widget->value)?></textarea>
        <div class="invalid-feedback"><?=$this->e($widget->error)?></div>
        <small class="form-text text-muted"><?=$this->e($widget->help)?></small>
    </div>
</div>
