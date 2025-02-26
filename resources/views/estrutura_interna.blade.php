<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{env('APP_NAME')}}</title>

    @include('estrutura.css')
    @yield('css_extra')

</head>

<body>
    <div class="conteudo" style="opacity: 0">

        @include('estrutura.header')

        @include('estrutura.sidebar')

        @yield('content')

    </div>

    @include('templates.carregando')

</body>

@include('estrutura.js')

@include('estrutura.aviso')

@yield('js_extra')

</html>
