<?php


namespace App\Admin\Types;

/**
 * Interface TypeGridField
 * @package App\Admin\Types
 *
 * @property string $name   字段名称
 * @property string $label  字段标题
 * @property mixed $type    显示类型
 * @property callable $cast 转换
 * @property bool $is_sort 是否是排序字段
 */
interface TypeGridColumn
{

}