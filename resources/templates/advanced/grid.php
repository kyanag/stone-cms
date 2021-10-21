<?php
/** @var \App\Admin\Widgets\Grid $grid */

/** @var \Illuminate\Pagination\Paginator $paginator */
$paginator = $grid->getPaginator();
?>
<div class="btn-toolbar justify-content-between mb-3" role="toolbar" aria-label="操作栏">
    <div class="btn-toolbar-left">
        <?php foreach($grid->getLinkGroups() as $name => $links): ?>
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
                <?php foreach($grid->getColumns() as $column): if(@$column['sortable'])?>
                    <a class="dropdown-item" href="<?php echo e(url()->withQuery(null, ['sort' => "{$column['name']}@asc"])); ?>"><?=e($column['title'])?> 升序</a>
                    <a class="dropdown-item" href="<?php echo e(url()->withQuery(null, ['sort' => "{$column['name']}@desc"])); ?>"><?=e($column['title'])?> 降序</a>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>
<div class="row collapse" id="advanced-search-toggle">
    111
</div>
<table class="table">
    <thead>
    <tr>
        <?php foreach($grid->getColumns() as $column): ?>
            <th class="<?=e(@$column['headerClasses'])?>"><?=e($column['title'])?></th>
        <?php endforeach; ?>
    </tr>
    </thead>
    <tbody>
    <?php foreach($paginator->getCollection() as $index => $item): ?>
        <tr>
            <?php foreach($grid->getColumns() as $column): ?>
                <th class="<?=e(@$column['rowClasses']); ?>">
                    <?=call_user_func_array($column['cast'], [$index, $item, @$item[$column['name']]])?>
                </th>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<nav aria-label="Page navigation example" class="float-right">
    <?=$paginator->appends([])->render(); ?>

</nav>