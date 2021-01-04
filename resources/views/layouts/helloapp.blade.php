<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--初期化-->
    <link rel="stylesheet" href="{{ asset('/css/destyle.css') }}">
    <!--ライブラリ-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" media="all" />
    <!--カスタマイズ-->
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
</head>

<body>
    <div class="header">
        @yield('header__btn--before')
        <h1 class="header__ttl">@yield('title')</h1>
        @yield('header__btn--after')
    </div>

    <div class="panel panel--crystal">
        <div class="panel__ttl">努力の結晶</div>
        <div class="panel__num">{{App\Models\Crystal::number()}}</div>
    </div><!--panel END-->

    @section('menubar')
    <ul>
        <li>@show</li>
    </ul>
    <div class="content">
        @yield('content')
    </div>
    <div class="footer">
        @yield('footer')
    </div>
    <script src="{{ asset('/js/app.js') }}"></script>
</body>
</html>