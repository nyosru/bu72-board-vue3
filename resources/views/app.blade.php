<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <meta name="author" content="Sergey Baklanov php-cat.com">
    <meta name="generator" content="u">
    <title>БУ72 доска обьявлений</title>

    {{-- @auth --}}

    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- @endauth --}}

    {{-- <!-- Bootstrap core CSS --> --}}
    {{-- <link href="/docs/5.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}
    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    {{-- <!-- Favicons --> --}}
    @if (1 == 2)
        <link rel="apple-touch-icon" href="/docs/5.1/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
        <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
        <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
        <link rel="manifest" href="/docs/5.1/assets/img/favicons/manifest.json">
        <link rel="mask-icon" href="/docs/5.1/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
        <meta name="theme-color" content="#7952b3">
    @endif

    <link rel="icon" href="/vitrin/favicon.ico" />

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

    </style>

</head>

<body>

    <div class="container-fluid" id="app">

        <header class="navbar navbar-ligth sticky-top xbg-dark    bg-light    flex-md-nowrap p-0 shadow">

            <a class="navbar-brand text-center col-md-3 col-lg-2 p-3 xme-0 xpx-3" href="/">бу72.рф</a>

            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- <div class="navbar-nav"> --}}
            {{-- <div class="nav-item text-nowrap"> --}}

            @guest
                <top-links domain="@php echo $_SERVER['HTTP_HOST']; @endphp" />
            @endguest

            @auth
                {{-- Auth::user()->id  = {{ Auth::user()->id }} --}}
                <top-links :user-id-n="{{ Auth::user()->id ?? '' }}" user-name="{{ Auth::user()->name ?? '' }}"
                    :user-avatar="'{{ Auth::user()->avatar ?? '' }}'" domain="@php echo $_SERVER['HTTP_HOST']; @endphp" />
            @endauth

        </header>

        <main class="col-12 xcol-md-9 xms-sm-auto xcol-lg-10 xpx-md-4" style="min-height:100vh;">

            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-3">
                        <router-view name="leftMenu"></router-view>
                    </div>
                    <div class="col-9">
                        <router-view name="center"></router-view>
                        @section('content')
                        @show
                    </div>
                </div>
            </div>

        </main>

        <div v-if="showWarning"
            style="position:fixed; bottom: 50px; left: 0; rigth: 0; background-color: rgba(255,255,0,0.8)">

            <button class="btn btn-sm" style="float: right;" @click="showWarning = !showWarning">закрыть</button>

            <p class="text-center" style="padding-left: 20vw; padding-right: 20vw;">

                <br />
                Доска обьявлений мой
                домашний проект, я Сергей Бакланов <a href="https://php-cat.com" target="_blank">php-cat.com</a>

                <br />
                <br />
                <b>Запуск</b> запланирован на январь 2022 года,

                {{-- <br />
                <br />
                <b>Программистам</b> прокачиваешься во vue3 и php, напиши мне, есть масса различных задач
                <br />
                <br />
                <b>Приглашаю инвесторов</b> будет супер если у вас есть желание идеями направлять новый цифровой проект, инвестиции от 200тр поучаствовать (экспанисия, увеличение команды разработки, рекламный
                бюджет) в этом интересном проекте который поможет людям своей работой --}}

            </p>

        </div>

    </div>

</body>

@guest
    <script src="//ulogin.ru/js/ulogin.js"></script>
@endguest

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script src="/vitrin/app.js?{{ date('U') }}"></script>

</html>
