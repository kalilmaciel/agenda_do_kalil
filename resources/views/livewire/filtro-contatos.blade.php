<div>
    <div class="row">
        <div class="col s12">
            <form wire:submit="submit">
                <div class="filtros">
                    <div class="titulo">
                        <span>
                            Filtros
                        </span>
                        <div class="selects">
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
                    </div>
                    <div class="conteudo">
                        <div class="row no-margin-bottom">
                            <div class="col m10 s12 input-field">
                                <input type="text" id="busca" wire:model="busca" />
                                <label for="busca">Entre com sua busca </label>
                                <span class="helper-text">(Nome, email, telefone, celular ou CPF)</span>
                            </div>
                            <div class="col m2 s12">
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" value="1" name="mapa"
                                            wire:model="exibir_mapa" wire:change="submit" />
                                        <span>Mostrar mapa</span>
                                    </label>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="rodape right-align">
                        <a href="#!" wire:click="limparBusca()" class="btn waves-effect waves-light blue redondo">
                            <i class="fa fa-2x fa-times left"></i>
                            Limpar busca
                        </a>
                        <button type="submit" class="btn waves-effect waves-light redondo">
                            <i class="fa fa-2x fa-search left"></i>
                            Buscar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
