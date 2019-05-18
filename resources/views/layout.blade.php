<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> <!-- Загрузить нормально шрифты на сайт TODO !-->

    <link rel="stylesheet" href="{{ asset('/css/photoswipe.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/default-skin.css') }}">

    <link rel="stylesheet" href="{{ asset('/css/Bootstrap/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MUNRFE</title>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg bg-transparent">
        <div class="d-flex flex-grow-1">
            <a class="navbar-brand" href="#">
                <a  href="{{ route('main') }}"><img id="navbar-image" src="{{ asset('/images/Logo.svg') }}" alt="munrfe main logo"></a>
            </a>
            <div class="w-100 text-right">
                <button class="custom-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar7">
                    &#9776;
                </button>
            </div>
        </div>
        <div class="collapse navbar-collapse flex-grow-1 text-right" id="myNavbar7">
            <ul class="navbar-nav ml-auto flex-nowrap">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">MUNRFE</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">About us</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Other projects</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Contact us</a>
                </li>
            </ul>
        </div>
    </nav>
    <hr/>
    <main>
        @yield('content')
    </main>
    <footer class="page-footer font-small" style="margin-top: 100px;">
    </footer>
</div>
    <script src="{{ asset('/js/app.js') }}"></script>

    <script src="{{ asset('js/photoswipe.js') }}"></script>
    <script src="{{ asset('js/photoswipe-ui-default.js') }}"></script>
</body>
</html>