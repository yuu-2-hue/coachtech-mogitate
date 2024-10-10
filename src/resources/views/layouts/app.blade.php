<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Mogitate</title>
        <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
        <link href="https://fonts.cdnfonts.com/css/jsmath-cmti10" rel="stylesheet">
        @yield('css')
        @livewireStyles
    </head>

    <body>
        @livewireScripts
        <header class="header__container">
            <div class="header__inner">
                <a class="header__logo" href="/products">mogitate</a>
            </div>
        </header>

        <main>
            @yield('content')
        </main>

    </body>
</html>