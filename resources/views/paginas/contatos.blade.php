
@extends('estrutura_interna')

@section('js_extra')
    <script src="{{ asset('assets/js/controllers/ContatosController.js') }}"></script>
    <script src="{{ asset('assets/js/controllers/MapaController.js') }}"></script>
    <script src="{{ asset('assets/node_modules/leaflet/dist/leaflet.js') }}"></script>
@endsection

@section('css_extra')
    <link rel="stylesheet" href="{{ asset('assets/node_modules/leaflet/dist/leaflet.css') }}">
@endsection

@section('content')

    @livewire('lista-contatos')

@endsection
