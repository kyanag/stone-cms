<?php
/** @var \App\Supports\Widget $widget */
/** @var \League\Plates\Template\Template $this */
?>
<input
    name="<?=$this->e($widget->name)?>"
    value="<?=$this->e($widget->value)?>"
    type="hidden"
    <?=\Kyanag\Form\renderAttributes([
        'class' => $this->e($widget->class),
        'id' => $this->e($widget->id),
        'disabled' => boolval($widget->disabled),
    ])?>
>
