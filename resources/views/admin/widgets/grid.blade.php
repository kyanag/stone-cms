<?php
/** @var \App\Admin\Widgets\Grid $grid */

/** @var \Illuminate\Pagination\Paginator $paginator */
$paginator = $grid->getPaginator();

$toolbar = $grid->getToolbar();
?>
@if($toolbar)
    {!! $toolbar->render() !!}
@endif
<table class="table">
    <thead>
    <tr>
        @foreach($grid->getColumns() as $column)
            <th class="{{ $column->getHeaderClass() }}" style="{{ $column->getHeaderStyle() }}">{!! $column->getTitle() !!}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    <?php $i = 0;?>
    @foreach($grid->getItems() as $key => $item)
    <tr>
        @foreach($grid->getColumns() as $column)
        <th class="{{ $column->getCellClass($key, $item, $i) }}" style="{{ $column->getCellStyle($key, $item, $i) }}">
            {!! call_user_func_array($column, [$key, $item, $i]) !!}
        </th>
        @endforeach
    </tr>
    @endforeach
    <?php unset($i);?>
    </tbody>
</table>
<nav aria-label="Page navigation example" class="float-right">
    {!! $paginator->render() !!}
</nav>
