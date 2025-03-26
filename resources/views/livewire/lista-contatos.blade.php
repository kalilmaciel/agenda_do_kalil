@inject('funcoes', 'App\Services\Funcoes')

<div>
    <input type="hidden" name="latitude" id="latitude" value="{{ floatval($user['latitude']) }}">
    <input type="hidden" name="longitude" id="longitude" value="{{ floatval($user['longitude']) }}">

    <main>

        <div class="row titulo-mobile hide-on-med-and-up">
            <div class="col s12">
                <h5>Contatos</h5>
            </div>
        </div>

        <form class="row no-margin-bottom" wire:submit="submit" onsubmit="carregando(true)">
            @csrf
            <div class="col s12">
                <ul class="collapsible filtro" data-collapsible="accordion">
                    <li class="active">
                        <div class="collapsible-header">
                            <strong>Filtros</strong>
                        </div>
                        <div class="select-por-pagina">

                            <div class="input-field tooltipped" data-position="top" data-tooltip="Paginação">
                                <select id="por_pagina" class="browser-default" wire:model="por_pagina">
                                    <option value="20">20 por página</option>
                                    <option value="60">60 por página</option>
                                    <option value="100">100 por página</option>
                                </select>
                            </div>
                            <div class="input-field tooltipped" data-position="top" data-tooltip="Ordenação">
                                <select id="ordem" class="browser-default" wire:model="ordem">
                                    <option value="d_asc">Dt.Cadastro ↗</option>
                                    <option value="d_dec">Dt.Cadastro ↘</option>
                                    <option value="a_asc">Nome ↗</option>
                                    <option value="a_dec">Nome ↘</option>
                                    <option value="l_asc">Distância ↗</option>
                                    <option value="l_dec">Distância ↘</option>
                                </select>
                            </div>
                        </div>
                        <div class="collapsible-body">
                            <div class="row no-margin-bottom">
                                <div class="col s12 input-field">
                                    <input type="text" id="busca" wire:model="busca" />
                                    <label for="busca">Entre com sua busca </label>
                                    <span class="helper-text">(Nome, email, telefone, celular ou CPF)</span>
                                </div>

                            </div>
                            <div class="row no-margin-bottom">
                                <div class="col m6 s12">
                                    <p>
                                        <label>
                                            <input type="checkbox" class="filled-in" value="1" name="mapa"
                                                wire:model="exibir_mapa" wire:change="submit" />
                                            <span>Mostrar mapa</span>
                                        </label>
                                    </p>
                                </div>
                                <div class="col m6 s12 right-align">
                                    <a href="#!" wire:click="limparBusca()" onclick="carregando(true)" class="btn waves-effect waves-light blue redondo">
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
            <div class="col {{ $exibir_mapa == '1' ? 'm6 s12' : 's12' }}">
                <x-lista-contatos :lista="$contatos" />
            </div>
            @if ($exibir_mapa == '1')
                <div class="col {{ $exibir_mapa == '1' ? 'm6 s12' : 's12' }}">
                    <div id="div_mapa" class="mapa"></div>
                </div>
            @endif
            <div class="col s12 center">
                {{ !empty($contatos) ? $contatos->links() : '' }}
            </div>
        </div>

        <div class="botao-adicionar">
            <a href="{{ route('detalhar-contato', ['id' => $funcoes->encrypt('0')]) }}"
                class="btn-floating btn-large waves-effect waves-light orange">
                <i class="material-icons">add</i>
            </a>
        </div>

    </main>
</div>
