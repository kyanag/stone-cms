<?php
/** @var \Kyanag\Form\Core\Widget $widget */
/** @var \League\Plates\Template\Template $this */
?>
<div class="form-group row">
    <label class="col-md-2 col-form-label" for="<?=$this->e($widget->getId())?>"><?=$this->e($widget->getLabel())?></label>
    <div class="col-md-10">
        <textarea
            name="<?=$this->e($widget->getName())?>"
            class="form-control <?=$this->e($widget->getClass())?>"
            <?=\Kyanag\Form\renderAttributes([
                'rows' => intval($widget->getRows() ?: 3),
                'id' => $this->e($widget->getId()),
                'readonly' => boolval($widget->isReadonly()),
                'disabled' => boolval($widget->isDisabled()),
                'placeholder' => $this->e($widget->getPlaceholder()),
                'style' => $this->e($widget->getStyle())
            ])?>
        ><?=$this->e($widget->getValue())?></textarea>
        <div class="invalid-feedback"><?=$this->e($widget->getError())?></div>
        <small class="form-text text-muted"><?=$this->e($widget->getHelp())?></small>
    </div>
</div>
