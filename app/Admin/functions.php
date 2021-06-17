<?php

use Kyanag\Form\Core\ArrayElement;

function array2FormFields(array $items = []){
    return array_map(function($item){
        return new ArrayElement($item);
    }, $items);
}