
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
<header class="navbar navbar-expand bg-darkblue">
    <a class="navbar-brand mr-0 mr-md-2" href="/">
        StoneCMS
    </a>
    <div class="navbar-nav-scroll">
        <ul class="navbar-nav bd-navbar-nav flex-row">
            <li class="nav-item">
                <a class="nav-link" href="/" onclick="ga('send', 'event', 'Navbar', 'Community links', 'Bootstrap');">首页</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/docs/getting-started/introduction/" onclick="ga('send', 'event', 'Navbar', 'Community links', 'Docs');">中文文档</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/docs/examples/" onclick="ga('send', 'event', 'Navbar', 'Community links', 'Examples');">示例</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://icons.bootcss.com/" onclick="ga('send', 'event', 'Navbar', 'Community links', 'Icons');" target="_blank" rel="noopener">图标库</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://themes.getbootstrap.com/" onclick="ga('send', 'event', 'Navbar', 'Community links', 'Themes');" target="_blank" rel="noopener">模板/主题</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://www.youzhan.org/" onclick="ga('send', 'event', 'Navbar', 'Community links', 'Expo');" target="_blank" rel="noopener">优站精选</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://blog.getbootstrap.com/" onclick="ga('send', 'event', 'Navbar', 'Community links', 'Blog');" target="_blank" rel="noopener">官方博客</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://www.sasscss.com/" target="_blank" rel="noopener">Sass</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://www.rollupjs.com/" target="_blank" rel="noopener">rollup.js</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://www.babeljs.cn/" target="_blank" rel="noopener">Babel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://www.gohugo.cn/" target="_blank" rel="noopener">Hugo</a>
            </li>
        </ul>
    </div>
</header>
<main role="main" class="flex-xl-nowrap">
    <div id="sidebar">

    </div>
    <div id="content">
        @yield("main")
    </div>
</main>
</body>

<script src="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/mdbootstrap/4.9.0/js/mdb.js"></script>

<script src="https://cdn.bootcdn.net/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>

<script src="https://cdn.bootcdn.net/ajax/libs/placeholder.js/3.1.0/placeholder.min.js"></script>

<script src="https://cdn.bootcdn.net/ajax/libs/flatpickr/4.6.6/flatpickr.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/flatpickr/4.6.6/l10n/zh.min.js"></script>
</html>