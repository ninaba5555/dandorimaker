<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--初期化-->
    <link rel="stylesheet" href="{{ asset('/css/destyle.css') }}">
    <!--カスタマイズ-->
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
</head>

<body>
    <h1 class="heading">@yield('title')</h1>
    <div class="crystal">
        <div class="crystal__title">努力の結晶:</div>
        <div class="crystal__number">{{App\Models\Crystal::number()}}</div>
    </div><!--crystal END-->

    
    @section('menubar')
    <h2 class="menutitle">※メニュー</h2>
    <ul>
        <li>@show</li>
    </ul>
    <hr size="1">
    <div class="content">
        @yield('content')
    </div>
    <div class="footer">
        @yield('footer')
    </div>
    <script src="{{ asset('/js/app.js') }}"></script>
</body>
</html>