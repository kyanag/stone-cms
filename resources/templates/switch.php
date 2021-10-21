<?php
/** @var \App\Supports\Widget $widget */
/** @var \League\Plates\Template\Template $this */

$id = $widget->id ?: uniqid("switch-");
?>
<div class="form-group row">
    <div class="col-md-2"><?=$this->e($widget->label)?></div>
    <div class="col-md-10">
        <div class="custom-control custom-switch">
            <input class="custom-control-input" type="checkbox"
                name="<?=$this->e($widget->name)?>"
                value="1"
                <?=\Kyanag\Form\renderAttributes([
                    'checked' => boolval($widget->value),
                    'id' => $this->e($widget->id),
                    'readonly' => boolval($widget->readonly),
                    'disabled' => boolval($widget->disabled),
                    'style' => $this->e($widget->style)
                ])?>
            >
            <label class="custom-control-label" for="<?=$this->e($id)?>">
                <?=$widget->help?>
            </label>
            <div class="invalid-feedback"><?=$widget->error?></div>
        </div>

    </div>
</div>
