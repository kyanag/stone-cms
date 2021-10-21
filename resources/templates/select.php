<?php
/** @var \App\Supports\Widget $widget */
/** @var \League\Plates\Template\Template $this */
?>
<div class="form-group row">
    <label class="col-md-2 col-form-label" for="<?=$this->e($widget->id)?>"><?=$this->e($widget->label)?></label>
    <div class="col-md-10">
        <select
            name="<?=$this->e($widget->name)?>"
            class="form-control <?=$this->e($widget->class)?>"
            <?=\Kyanag\Form\renderAttributes([
                'id' => $this->e($widget->id),
                'readonly' => boolval($widget->readonly),
                'disabled' => boolval($widget->disabled),
                'placeholder' => $this->e($widget->placeholder),
                'style' => $this->e($widget->style),
                'multiple' => boolval($widget->multi),
            ])?>
        >
            <?php foreach ($widget->options as $option) { ?>
            <option
                <?=\Kyanag\Form\renderAttributes([
                    'value' => $this->e($option->value),
                    'disabled' => boolval($option->disabled),
                    'selected' => boolval($option->selected),
                ])?>
            ><?=$option->label?></option>
            <?php } ?>
        </select>
        <div class="invalid-feedback"><?=$widget->error?></div>
        <small class="form-text text-muted"><?=$widget->help?></small>
    </div>
</div>
