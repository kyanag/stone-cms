<?php
/** @var \App\Supports\Widget $widget */
/** @var \League\Plates\Template\Template $this */

$unique = uniqid("radio-");
?>
<div class="form-group row">
    <div class="col-md-2"><?=$this->e($widget->label)?></div>
    <div class="col-md-10">
        <?php foreach ($widget->options as $index => $option) {?>
        <div class="form-check">
            <input class="form-check-input" type="radio"
                   name="<?=$this->e($widget->name)?>"
                <?=\Kyanag\Form\renderAttributes([
                    'id' => "{$unique}-{$index}",
                    'checked' => boolval($option->selected),
                    'disabled' => boolval($option->disabled),
                    'value' => $this->e($option->value),
                ])?>
            >
            <label class="form-check-label" for="<?="{$unique}-{$index}"?>">
                <?=$this->e($option->label)?>
            </label>
        </div>
        <?php } ?>
        <div class="invalid-feedback"><?=$widget->error?></div>
        <small class="form-text text-muted"><?=$widget->help?></small>
    </div>
</div>
