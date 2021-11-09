<?php
/** @var \App\Admin\Widgets\Grid $widget */

/** @var \Illuminate\Pagination\Paginator $paginator */
$paginator = $widget->getPaginator();
?>
<div class="btn-toolbar justify-content-between mb-3" role="toolbar" aria-label="操作栏">
    <div class="btn-toolbar-left">
        <?php foreach($widget->getLinkGroups() as $name => $links): ?>
            <div class="btn-group mb-2 mr-2" role="group" aria-label="tool-group-<?php echo e($name ?: "main"); ?>">
                <?php foreach($links as $index => $link): ?>
                    <?php if(!isset($link['children'])): ?>
                        <a type="button" class="btn btn-<?=e($link['type'])?>" href="<?=e($link['url'])?>"><?=e($link['title'])?></a>
                    <?php else: ?>
                        <div class="btn-group">
                            <a type="button" class="btn btn-<?=e($link['type'])?>" href="<?=e($link['url'])?>"><?=e($link['title'])?></a>
                            <button type="button" class="btn btn-primary dropdown-toggle active"
                                    data-toggle="dropdown" data-target="#toolbar-left-<?=e($name); ?>-<?=e($index); ?>" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="toolbar-left-<?=e($name)?>-<?=e($index)?>">
                                <?php foreach($link['children'] as $child_link):?>
                                    <a class="dropdown-item" href="<?=e($child_link['url'])?>"><?=e($child_link['title'])?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach;?>
            </div>
        <?php endforeach;?>
    </div>
    <div class="btn-toolbar-right d-flex mb-2">
        <form>
            <div class="input-group">
                <input type="text" name="keyword" class="form-control" placeholder="请输入关键字" aria-label="请输入关键字" required>
                <div class="input-group-append">
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">搜索</button>
                        <button type="button" class="btn btn-primary dropdown-toggle active" title="高级搜索" data-toggle="collapse" data-target="#advanced-search-toggle" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <div class="btn-group pl-2" style="width: 100px" role="group">
            <button id="toolbar-sort" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">排序 </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="toolbar-sort">
                <?php foreach($widget->getColumns() as $column): if($column->isSortable())?>
                    <a class="dropdown-item" href="<?php echo e(url()->withQuery(null, ['sort' => "{$column->getName()}@asc"])); ?>"><?=e($column->getTitle())?> 升序</a>
                    <a class="dropdown-item" href="<?php echo e(url()->withQuery(null, ['sort' => "{$column->getName()}@desc"])); ?>"><?=e($column->getTitle())?> 降序</a>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>
<!--<div class="row collapse" id="advanced-search-toggle">-->
<!--    <?//= app("renderer")->render($widget->toForm()) ?>-->
<!--</div>-->
<table class="table">
    <thead>
    <tr>
        <?php
        /** @var \App\Admin\Widgets\Column $column */
        foreach($widget->getColumns() as $column): ?>
            <th class="<?=$column->getHeaderClass()?>" style="<?=$column->getHeaderStyle() ?>"><?=$column->getTitle()?></th>
        <?php endforeach; ?>
    </tr>
    </thead>
    <tbody>
    <?php $i = 0;foreach($paginator->getCollection() as $key => $item): ?>
        <tr class="<?= $column->getRowClass($key, $item, $i)?>" style="<?= $column->getRowStyle($key, $item, $i)?>">
            <?php foreach($widget->getColumns() as $column): ?>
                <th class="<?= $column->getCellClass($key, $item, $i)?>" style="<?=$column->getCellStyle($key, $item, $i); ?>">
                    <?=call_user_func_array($column, [$key, $item, $i])?>
                </th>
            <?php endforeach; ?>
        </tr>
    <?php $i++;endforeach;unset($i); ?>
    </tbody>
</table>
<nav aria-label="Page navigation example" class="float-right">
    <?=$paginator->appends([])->render(); ?>
</nav>
