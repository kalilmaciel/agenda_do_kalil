@inject('funcoes', 'App\Services\Funcoes')

@extends('estrutura_interna')

@section('js_extra')
    <script src="{{ asset('assets/js/controllers/ContatoController.js') }}"></script>
@endsection


@section('content')
    <main>
        <div class="row titulo-mobile hide-on-med-and-up">
            <div class="col s12">
                <h5>Contato</h5>
            </div>
        </div>

        <form method="POST" action="{{ route('salvar-contato') }}" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="id" id="id" value="{{ $funcoes->encrypt($funcoes->setValue($contato, 'id', old('id'))) }}">

            <div class="container">
                <div class="row">
                    <div class="col m4 s12 center-align">
                        <a href="{{ $contato['imagem'] ? $funcoes->getImagem($contato['imagem'], 'contatos') : asset('assets/img/usuario.png') }}"
                            data-fancybox="gallery" data-caption="Imagem">
                            <img class="foto_upload 1"
                                src="{{ $contato['imagem'] ? $funcoes->getImagem($contato['imagem'], 'contatos') : asset('assets/img/usuario.png') }}" />
                        </a>
                        <br>
                        <div class="file-field">
                            <div class="btn-small redondo btn-full blue darken-2 no-margin">
                                <span> <i class="fa-solid fa-image left"></i> Imagem</span>
                                <input type="file" name="foto" accept="image/*" maxsize="5120" />
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate hide" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col m8 s12 ">
                        <div class="row no-margin-bottom">
                            <div class="col s12 input-field no-margin-bottom">
                                <input type="text" id="name" name="name" class="validate"
                                    value="{{ $funcoes->setValue($contato, 'name', old('name')) }}" required />
                                <label for="name">Nome</label>
                            </div>
                            <div class="col s12 input-field no-margin-bottom">
                                <input type="text" id="email" name="email" class="validate"
                                    value="{{ $funcoes->setValue($contato, 'email', old('email')) }}" />
                                <label for="email">Email</label>
                            </div>
                            <div class="col m6 s12 input-field no-margin-bottom">
                                <input type="text" id="celular" name="celular" class="validate" required
                                    value="{{ $funcoes->formatar($funcoes->setValue($contato, 'celular', old('celular')), 'telefone') }}"
                                    onkeyup="mascara('(##) #####-####',this,event)" required />
                                <label for="celular">Celular</label>
                            </div>
                            <div class="col m6 s12 input-field no-margin-bottom">
                                <input type="text" id="telefone" name="telefone" class="validate"
                                    value="{{ $funcoes->formatar($funcoes->setValue($contato, 'telefone', old('telefone')), 'telefone') }}"
                                    onkeyup="mascara('(##) #####-####',this,event)" />
                                <label for="telefone">Telefone</label>
                            </div>
                            <div class="col m6 s12 input-field no-margin-bottom">
                                <input type="text" id="cpf_cnpj" name="cpf_cnpj" class="validate"
                                    value="{{ $funcoes->formatar($funcoes->setValue($contato, 'cpf_cnpj', old('cpf_cnpj')), 'cpfcnpj') }}"
                                    onkeyup="mascara('###.###.###-##',this,event)" />
                                <label for="cpf_cnpj">CPF</label>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row no-margin-bottom">
                    <div class="col m4 s6 input-field no-margin-bottom">
                        <input type="text" id="cep" name="cep" class="validate" required
                            value="{{ $funcoes->formatar($funcoes->setValue($contato, 'cep', old('cep')), 'cep') }}"
                            onkeyup="mascara('##.###-###',this,event)" onblur="getEndereco(this)" />
                        <label for="cep">CEP</label>
                    </div>
                    <div class="col m8 s12 input-field no-margin-bottom">
                        <input type="text" id="endereco" name="endereco" class="validate"
                            value="{{ $funcoes->setValue($contato, 'endereco', old('endereco')) }}" />
                        <label for="endereco">Endereço</label>
                    </div>
                    <div class="col m8 s12 input-field no-margin-bottom">
                        <input type="text" id="complemento" name="complemento" class="validate"
                            value="{{ $funcoes->setValue($contato, 'complemento', old('complemento')) }}" />
                        <label for="complemento">Complemento</label>
                    </div>
                    <div class="col m4 s6 input-field no-margin-bottom">
                        <input type="text" id="bairro" name="bairro" class="validate" required
                            value="{{ $funcoes->setValue($contato, 'bairro', old('bairro')) }}" />
                        <label for="bairro">Bairro</label>
                    </div>
                    <div class="col s6 input-field no-margin-bottom">
                        <input type="text" id="cidade" name="cidade" class="validate" required
                            value="{{ $funcoes->setValue($contato, 'cidade', old('cidade')) }}" />
                        <label for="cidade">Cidade</label>
                    </div>
                    <div class="col s6 input-field no-margin-bottom">
                        @include('templates.select_uf', [
                            'id' => 'uf',
                            'name' => 'uf',
                            'objeto' => $contato,
                            'atributo' => 'uf',
                            'old_value' => old('uf'),
                        ])
                        <label for="uf">Estado</label>
                    </div>

                </div>

            </div>

            <div class="botoes-acao">
                <div class="card">
                    <div class="container row no-margin-bottom ">
                        <div class="col s12 right-align">
                            <button type="submit" class="btn-small green waves-effect redondo">
                                <i class="fa fa-2x fa-check left"></i>
                                Salvar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </main>
@endsection
