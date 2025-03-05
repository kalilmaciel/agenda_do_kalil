<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>

    <meta name="robots" content="noindex" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta name="description" content="Sistema Gestão de contatos." />
    <meta name="keywords" content="sistema contatos pessoas telefone localizacao" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta property="og:title" content="{{env('APP_SITE')}}" />
    <meta property="og:url" content="{{env('APP_URL')}}" />
    <meta property="og:og:site_name" content="{{env('APP_SITE')}}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="{{asset('assets/img/favicon.png')}}" />

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
