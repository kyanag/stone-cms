<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="kyanag">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="autocomplete" content="off">
    <title>登录 - StoneCMS</title>

    <link href="https://cdn.staticfile.org/bootswatch/4.5.1/cosmo/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.staticfile.org/font-awesome/5.14.0/css/all.min.css" rel="stylesheet">

    <link href="https://cdn.staticfile.org/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.staticfile.org/animate.css/4.1.1/animate.min.css" rel="stylesheet">

    <link href="{{ asset("/storage/css/style.css") }}" rel="stylesheet">
    <script src="https://cdn.staticfile.org/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<header class="navbar navbar-expand bg-darkblue fixed-top">
    <a class="navbar-brand mr-0 mr-md-2" href="/">

    </a>
    <div class="navbar-nav-scroll">
        <ul class="navbar-nav bd-navbar-nav flex-row">
            <li class="nav-item">
                <a class="nav-link" href="/" onclick="ga('send', 'event', 'Navbar', 'Community links', 'Bootstrap');">首页</a>
            </li>

        </ul>
    </div>
</header>
<main role="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 offset-3">
                <div class="pt-5"></div>
                <h2>StoneCMS</h2>
                {!!
                    app("renderer")->render($loginForm)
                !!}
            </div>
        </div>
    </div>
    <footer>

    </footer>
</main>

</body>

<script src="https://cdn.staticfile.org/twitter-bootstrap/4.5.1/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.staticfile.org/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>
</html>
