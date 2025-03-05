@inject('funcoes', 'App\Services\Funcoes')

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
    <input type="hidden" name="latitude" id="latitude" value="{{ floatval($user['latitude']) }}">
    <input type="hidden" name="longitude" id="longitude" value="{{ floatval($user['longitude']) }}">

    <main>

        <div class="row titulo-mobile hide-on-med-and-up">
            <div class="col s12">
                <h5>Contatos</h5>
            </div>
        </div>

        <form class="row no-margin-bottom" method="GET" action="{{ route('contatos') }}">
            @csrf
            <div class="col s12">
                <ul class="collapsible filtro" data-collapsible="accordion">
                    <li class="active">
                        <div class="collapsible-header">
                            <strong>Filtros</strong>
                        </div>
                        <div class="select-por-pagina">

                            <div class="input-field tooltipped" data-position="top" data-tooltip="Paginação">
                                <select name="por_pagina" class="browser-default">
                                    <option value="20" {{ $filtro->por_pagina == 20 ? 'selected' : '' }}>20 por página
                                    </option>
                                    <option value="60" {{ $filtro->por_pagina == 60 ? 'selected' : '' }}>60 por página
                                    </option>
                                    <option value="100" {{ $filtro->por_pagina == 100 ? 'selected' : '' }}>100 por página
                                    </option>
                                </select>
                            </div>
                            <div class="input-field tooltipped" data-position="top" data-tooltip="Ordenação">
                                <select name="ordem" class="browser-default">
                                    <option value="d_asc" {{ $filtro->ordem == 'd_asc' ? 'selected' : '' }}>Dt. Cadastro ↗
                                    </option>
                                    <option value="d_dec" {{ $filtro->ordem == 'd_dec' ? 'selected' : '' }}>Dt. Cadastro ↘
                                    </option>
                                    <option value="a_asc" {{ $filtro->ordem == 'a_asc' ? 'selected' : '' }}>Nome ↗
                                    </option>
                                    <option value="a_dec" {{ $filtro->ordem == 'a_dec' ? 'selected' : '' }}>Nome ↘
                                    </option>
                                    <option value="l_asc" {{ $filtro->ordem == 'l_asc' ? 'selected' : '' }}>Distância ↗
                                    </option>
                                    <option value="l_dec" {{ $filtro->ordem == 'l_dec' ? 'selected' : '' }}>Distância ↘
                                    </option>
                                </select>
                            </div>

                        </div>
                        <div class="collapsible-body">
                            <div class="row no-margin-bottom">
                                <div class="col s12 input-field">
                                    <input type="text" id="busca" name="busca" value="{{ $filtro->busca }}" />
                                    <label for="busca">Entre com sua busca (Nome, email, telefone, celular ou
                                        CPF)</label>
                                </div>

                            </div>
                            <div class="row no-margin-bottom">
                                <div class="col m6 s12">
                                    <p>
                                        <label>
                                            <input type="checkbox" class="filled-in" value="1"
                                                {{ $funcoes->setChecked($filtro, 'mapa') }} onchange="this.form.submit()"
                                                name="mapa" />
                                            <span>Mostrar mapa</span>
                                        </label>
                                    </p>
                                </div>
                                <div class="col m6 s12 right-align">
                                    <a href="{{ route('contatos') }}" class="btn waves-effect waves-light blue redondo">
                                        <i class="fa fa-2x fa-times left"></i>
                                        Limpar busca
                                    </a>
                                    <button type="submit" class="btn waves-effect waves-light redondo">
                                        <i class="fa fa-2x fa-search left"></i>
                                        Buscar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </form>

        <div id="inicio"></div>

        <div class="row">
            <div class="col {{ $filtro->mapa == '1' ? 'm6 s12' : 's12' }}">
                <x-lista-contatos :lista="$contatos" />
            </div>
            @if ($filtro->mapa == '1')
                <div class="col {{ $filtro->mapa == '1' ? 'm6 s12' : 's12' }}">
                    <div id="div_mapa" class="mapa"></div>
                </div>
            @endif
            <div class="col s12 center">
                {{ $contatos->links() }}
            </div>
        </div>

        <div class="botao-adicionar">
            <a href="{{ route('detalhar-contato', ['id' => $funcoes->encrypt('0')]) }}"
                class="btn-floating btn-large waves-effect waves-light orange">
                <i class="material-icons">add</i>
            </a>
        </div>

    </main>
@endsection
