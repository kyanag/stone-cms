<?php
/** @var \App\Supports\Widget $widget */
/** @var \League\Plates\Template\Template $this */
?>
<div class="form-group row">
    <label class="col-md-2 col-form-label" for="<?=$this->e($widget->id)?>"><?=$this->e($widget->label)?></label>
    <div class="col-md-10">
        <input
            name="<?=$this->e($widget->name)?>"
            value="<?=$this->e($widget->value)?>"
            type="password"
            class="form-control <?=$this->e($widget->class)?>"
            <?=\Kyanag\Form\renderAttributes([
                'id' => $this->e($widget->id),
                'readonly' => boolval($widget->readonly),
                'disabled' => boolval($widget->disabled),
                'placeholder' => $this->e($widget->placeholder),
                'style' => $this->e($widget->style)
            ])?>
        >
        <div class="invalid-feedback"><?=$widget->error?></div>
        <small class="form-text text-muted"><?=$widget->help?></small>
    </div>
</div>
