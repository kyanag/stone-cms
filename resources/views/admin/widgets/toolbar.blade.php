<?php
/** @var \App\Admin\Widgets\Toolbar $toolbar */
?>
<div class="btn-toolbar justify-content-between mb-3" role="toolbar" aria-label="操作栏">
    <div class="btn-toolbar-left">
        @foreach($toolbar->getLinks("default") as $index => $link)
            @if(isset($link['children']) && count($link['children']) > 0))
                <div class="btn-group">
                    <a type="button" class="btn btn-{{ $link['type'] }}" href="{{ $link['url'] }}">{{ $link['title'] }}</a>
                    <button type="button" class="btn btn-primary dropdown-toggle active"
                            data-toggle="dropdown" data-target="#toolbar-links-default-{{ $index }}" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="toolbar-links-default-{{ $index }}">
                        @foreach($link['children'] as $index => $subLink)
                        <a class="dropdown-item" href="{{ $subLink['url'] }}">{{ $subLink['title'] }}</a>
                        @endforeach
                    </div>
                </div>
            @else
                <a type="button" class="btn btn-{{ $link['type'] }}" href="{{ $link['url'] }}">{{ $link['title'] }}</a>
            @endif
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
            <button id="toolbar-sort" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">排序 </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="toolbar-sort">
                @foreach($toolbar->getLinks(\App\Admin\Widgets\Toolbar::LINK_GROUP_SORT) as $index => $link)
                <a class="dropdown-item" href="{{ $link['url'] }}">{{ $link['title'] }}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>
