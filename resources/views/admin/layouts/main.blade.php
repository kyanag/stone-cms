<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="kyanag">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="autocomplete" content="off">
    <title>@yield('title', "工作台")</title>

    <link href="https://cdn.bootcdn.net/ajax/libs/bootswatch/4.5.1/cosmo/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/5.14.0/css/all.min.css" rel="stylesheet">

    <link href="https://cdn.bootcdn.net/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <link href="https://cdn.bootcdn.net/ajax/libs/jasny-bootstrap/4.0.0/css/jasny-bootstrap.css" rel="stylesheet">
    <link href="https://cdn.bootcdn.net/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

{{--    <link href="https://cdn.bootcdn.net/ajax/libs/mdbootstrap/4.9.0/css/mdb.css" rel="stylesheet">--}}
    <link href="{{ asset("/storage/css/style.css") }}" rel="stylesheet">
    <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
</head>
<body class="bg-light">
<header class="navbar navbar-expand bg-darkblue fixed-top">
    <a class="navbar-brand mr-0 mr-md-2" href="/">
        StoneCMS
    </a>
    <div class="navbar-nav-scroll">
        <ul class="navbar-nav bd-navbar-nav flex-row">
            <li class="nav-item">
                <a class="nav-link" href="/" onclick="ga('send', 'event', 'Navbar', 'Community links', 'Bootstrap');">首页</a>
            </li>

        </ul>
    </div>
    <ul class="navbar-nav ml-md-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle mr-md-2" href="#" id="bd-versions" data-toggle="dropdown" aria-expanded="false">
                {{ \Illuminate\Support\Facades\Auth::guard("admin")->user()->nickname }}
            </a>
            <div class="dropdown-menu dropdown-menu-right text-black-50">
                <a class="dropdown-item stone-clickajax" data-method="POST" data-url="{{ route("admin.logout") }}" data-confirm="确认退出？">退出</a>
            </div>
        </li>
    </ul>
</header>

@include("admin::toolkits.message")

<main role="main">
    <div id="sidebar">
        <div id="sidenav">
            <ul class="nav flex-column">
                @foreach(\App\Models\Admin\AdminMenu::tree() as $item)
                <li class="nav-item">
                    @if(count($item['_children']) == 0)
                        <a class="nav-link" href="{{ @$item['path'] }}">{{ $item['title'] }}</a>
                    @else
                        <div class="nav-link" data-toggle="collapse" data-target="#sidenav-node-{{ $item['id'] }}" aria-expanded="false" aria-controls="sidenav-node-{{ $item['id'] }}">
                            <a href="{{ @$item['path'] }}" class="pr-1">{{ $item['title'] }}</a>
                            <div class="float-right px-2 hover-bg-download"><i class="fa fa-angle-down fa-3" aria-hidden="true"></i></div>
                        </div>
                    @endif

                    @if(count($item['_children']))
                    <ul class="nav flex-column collapse" id="sidenav-node-{{ $item['id'] }}">
                        @foreach($item['_children'] as $item)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ @$item['path'] }}">{{ $item['title'] }}</a>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div id="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-10 offset-1">
                    <div class="pt-5"></div>
                    @yield("main")
                </div>
            </div>
        </div>
        <footer>

        </footer>
    </div>
</main>

</body>
<script src="{{ asset("/storage/js/main.js") }}"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js"></script>
{{--<script src="https://cdn.bootcdn.net/ajax/libs/mdbootstrap/4.9.0/js/mdb.js"></script>--}}

<script src="https://cdn.bootcdn.net/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>

<script src="https://cdn.bootcdn.net/ajax/libs/placeholder.js/3.1.0/placeholder.min.js"></script>

<script src="https://cdn.bootcdn.net/ajax/libs/flatpickr/4.6.6/flatpickr.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/flatpickr/4.6.6/l10n/zh.min.js"></script>
</html>