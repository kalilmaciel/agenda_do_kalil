<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{env('APP_NAME')}}</title>

    @include('estrutura.favicon')

    @include('estrutura.css')

    @yield('css_extra')

</head>

<body>

    @yield('content')

</body>

@include('estrutura.js')
@yield('js_extra')

@include('estrutura.aviso')

</html>
