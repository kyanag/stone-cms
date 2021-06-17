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

    <link href="https://cdn.bootcdn.net/ajax/libs/mdbootstrap/4.9.0/css/mdb.css" rel="stylesheet">
    <link href="{{ asset("/storage/css/style.css") }}" rel="stylesheet">
    <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
</head>
<body>
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
            <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" id="bd-versions" data-toggle="dropdown" aria-expanded="false">
                {{ \Illuminate\Support\Facades\Auth::guard("admin")->user()->nickname }}
            </a>
            <div class="dropdown-menu dropdown-menu-md-right" aria-labelledby="bd-versions">
                <a class="dropdown-item active" href="https://v4.bootcss.com/">最新版本 (4.6.x)</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="https://v5.bootcss.com/">v5 版本</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="https://v3.bootcss.com/">v3 版本</a>
                <a class="dropdown-item" href="https://v2.bootcss.com/">v2 版本</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/docs/versions/">退出</a>
            </div>
        </li>
    </ul>
</header>

@include("admin::toolkits.message")

<main role="main">
    <div id="sidebar">
        <div id="sidenav">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#">控制台</a>
                </li>
                <li class="nav-item">
                    <strong class="nav-link">栏目</strong>
                </li>
                <li class="nav-item">
                    <strong class="nav-link">内容</strong>
                </li>
                <li class="nav-item">
                    <strong class="nav-link">系统</strong>
                </li>
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
<script src="https://cdn.bootcdn.net/ajax/libs/mdbootstrap/4.9.0/js/mdb.js"></script>

<script src="https://cdn.bootcdn.net/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>

<script src="https://cdn.bootcdn.net/ajax/libs/placeholder.js/3.1.0/placeholder.min.js"></script>

<script src="https://cdn.bootcdn.net/ajax/libs/flatpickr/4.6.6/flatpickr.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/flatpickr/4.6.6/l10n/zh.min.js"></script>
</html>