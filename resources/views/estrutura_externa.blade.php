<!DOCTYPE html>
<html lang="pt-br">

<head>

    @include('estrutura.meta')

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
