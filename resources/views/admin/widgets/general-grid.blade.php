<?php
/** @var \App\Admin\Widgets\Grids\GeneralGrid $grid */
?>
<div class="btn-toolbar justify-content-between mb-3" role="toolbar" aria-label="操作栏">
    <div class="btn-toolbar-left">
        @foreach($grid->linkGroups() as $name => $links)
        <div class="btn-group mb-2 mr-2" role="group" aria-label="tool-group-{{ $name ?: "main" }}">
            @foreach($links as $index => $link)
            <a type="button" class="btn btn-{{ $link['type'] }}" href="{{ $link['url'] }}">{{ $link['title'] }}</a>
            @endforeach
        </div>
        @endforeach
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
            <button id="btnGroupDrop1" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">排序 </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                @foreach($grid->columnsForSort() as $column)
                <a class="dropdown-item" href="{{ url()->withQuery(null, ['sortBy' => $column['name'], "sortType" => "asc"]) }}">{{ $column['title'] }} 升序</a>
                <a class="dropdown-item" href="{{ url()->withQuery(null, ['sortBy' => $column['name'], "sortType" => "desc"]) }}">{{ $column['title'] }} 降序</a>
                @endforeach
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
        @foreach($grid->columns as $column)
        <th class="{{ @$column['headerClasses'] }}">{{ $column['title'] }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($grid->getItems() as $index => $item)
    <tr>
        @foreach($grid->columns as $column)
            <th class="{{ @$column['rowClasses'] }}">{!! is_callable(@$column['cast']) ? call_user_func_array($column['cast'], [
                $index,
                $item,
                @$item[$column['name']]
            ]) : @$item[$column['name']] !!}</th>
        @endforeach
    </tr>
    @endforeach
    </tbody>
</table>
<nav aria-label="Page navigation example" class="float-right">
    {!! $grid->getPaginator()->appends([])->render() !!}
</nav>