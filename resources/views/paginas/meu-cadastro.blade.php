@inject('funcoes', 'App\Services\Funcoes')

@extends('estrutura_interna')

@section('js_extra')
    <script src="{{ asset('assets/js/controllers/MapaController.js') }}"></script>
    <script src="{{ asset('assets/node_modules/leaflet/dist/leaflet.js') }}"></script>
    <script src="{{ asset('assets/js/controllers/MeuCadastroController.js') }}"></script>
@endsection

@section('css_extra')
    <link rel="stylesheet" href="{{ asset('assets/node_modules/leaflet/dist/leaflet.css') }}">
@endsection

@section('content')
    <main>
        <div class="row titulo-mobile hide-on-med-and-up">
            <div class="col s12">
                <h5>Meu Cadastro</h5>
            </div>
        </div>

        <form method="POST" action="{{ route('user-profile-information.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="hidden" name="id" id="id" value="{{ $funcoes->setValue($user, 'id', old('id')) }}">

            <div class="container">
                <div class="row">
                    <div class="col m4 s12 center-align">
                        <a href="{{ $user['imagem'] ? $funcoes->getImagem($user['imagem'], 'usuarios') : asset('assets/img/usuario.png') }}"
                            data-fancybox="gallery" data-caption="Imagem">
                            <img class="foto_upload 1"
                                src="{{ $user['imagem'] ? $funcoes->getImagem($user['imagem'], 'usuarios') : asset('assets/img/usuario.png') }}" />
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
                            @error('foto')
                                <span class="helper-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col m8 s12 ">
                        <div class="row no-margin-bottom">
                            <div class="col s12 input-field no-margin-bottom">
                                <input type="text" id="name" name="name" class="validate"
                                    value="{{ $funcoes->setValue($user, 'name', old('name')) }}" required />
                                <label for="name">Nome</label>
                                @error('name')
                                    <span class="helper-text red-text">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col m12 s12 input-field no-margin-bottom">
                                <input type="text" id="email" name="email" class="validate"
                                    value="{{ $funcoes->setValue($user, 'email', old('email')) }}" required />
                                <label for="email">Email</label>
                                @error('email')
                                    <span class="helper-text red-text">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col m8 s6 input-field no-margin-bottom">
                                <input type="text" id="cpf_cnpj" name="cpf_cnpj" class="validate"
                                    value="{{ $funcoes->formatar($funcoes->setValue($user, 'cpf_cnpj', old('cpf_cnpj')), 'cpfcnpj') }}"
                                    onkeyup="mascara('###.###.###-##',this,event)" />
                                <label for="cpf_cnpj">CPF</label>
                                @error('cpf_cnpj')
                                    <span class="helper-text red-text">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row no-margin-bottom">
                    <div class="col m4 s6 input-field no-margin-bottom">
                        <input type="text" id="cep" name="cep" class="validate"
                            value="{{ $funcoes->formatar($funcoes->setValue($user, 'cep', old('cep')), 'cep') }}"
                            onkeyup="mascara('##.###-###',this,event)" onblur="getEndereco(this)" />
                        <label for="cep">CEP</label>
                    </div>
                    <div class="col m8 s12 input-field no-margin-bottom">
                        <input type="text" id="endereco" name="endereco" class="validate"
                            value="{{ $funcoes->setValue($user, 'endereco', old('endereco')) }}" />
                        <label for="endereco">Endereço</label>
                    </div>
                    <div class="col m8 s12 input-field no-margin-bottom">
                        <input type="text" id="complemento" name="complemento" class="validate"
                            value="{{ $funcoes->setValue($user, 'complemento', old('complemento')) }}" />
                        <label for="complemento">Complemento</label>
                    </div>
                    <div class="col m4 s12 input-field no-margin-bottom">
                        <input type="text" id="bairro" name="bairro" class="validate"
                            value="{{ $funcoes->setValue($user, 'bairro', old('bairro')) }}" />
                        <label for="bairro">Bairro</label>
                    </div>
                    <div class="col m6 s12 input-field no-margin-bottom">
                        <input type="text" id="cidade" name="cidade" class="validate"
                            value="{{ $funcoes->setValue($user, 'cidade', old('cidade')) }}" />
                        <label for="cidade">Cidade</label>
                    </div>
                    <div class="col m6 s12 input-field no-margin-bottom">
                        @include('templates.select_uf', [
                            'id' => 'uf',
                            'name' => 'uf',
                            'objeto' => $user,
                            'atributo' => 'uf',
                            'old_value' => old('uf'),
                        ])
                        <label for="uf">Estado</label>
                    </div>
                    <div class="col m4 s12 input-field no-margin-bottom">
                        <input type="text" id="latitude" name="latitude" class="validate"
                            value="{{ $funcoes->setValue($user, 'latitude', old('latitude')) }}" />
                        <label for="latitude">Latitude</label>
                    </div>
                    <div class="col m4 s12 input-field no-margin-bottom">
                        <input type="text" id="longitude" name="longitude" class="validate"
                            value="{{ $funcoes->setValue($user, 'longitude', old('longitude')) }}" />
                        <label for="longitude">Longitude</label>
                    </div>
                    <div class="col m4 s12">
                        <br>
                        <a href="#!" onclick="getLocalizacaoReversa()" class="btn-small blue redondo">
                            Obter Endereço das coordenadas
                        </a>
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

        <div class="row no-margin-bottom container">
            <div class="col s12">
                <ul class="collapsible" id="collapsible_mapa">
                    <li class="{{ $user['latitude'] != 0.0 && $user['longitude'] != 0.0 ? 'active' : '' }}">
                        <div class="collapsible-header">
                            <i class="fad default-icon-theme fa-solid fa-map left"></i>
                            Localização no mapa
                            <a href="#!" onclick="getLocalizacao()"
                                class="secondary-content btn-small blue redondo">
                                <i class="fa fa-location-pin left"></i>
                                <span class="hide-on-med-and-down">Obter localização</span>
                            </a>
                        </div>
                        <div class="collapsible-body">
                            <div class="row destaques">
                                <div class="mapa" id="div_mapa"></div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row no-margin-bottom container">
            <div class="col s12">
                <ul class="collapsible" id="collapsible_mapa">
                    <li class="{{ $errors->updatePassword->any() ? 'active' : '' }}">
                        <div class="collapsible-header">
                            <i class="fad default-icon-theme fa-key left"></i>
                            Alteração de senha
                        </div>
                        <div class="collapsible-body">
                            <div class="row no-margin-bottom destaques">
                                <form method="POST" action="{{ route('user-password.update') }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="row no-margin-bottom">
                                        <div class="col m4 s6 input-field no-margin-bottom">
                                            <input type="password" id="current_password" name="current_password"
                                                class="validate" />
                                            <label for="current_password">Senha atual</label>
                                            @error('current_password')
                                                <span class="helper-text red-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col m4 s6 input-field no-margin-bottom">
                                            <input type="password" id="password" name="password" class="validate" />
                                            <label for="password">Nova Senha</label>
                                            @error('password')
                                                <span class="helper-text red-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col m4 s6 input-field no-margin-bottom">
                                            <input type="password" id="password_confirmation"
                                                name="password_confirmation" class="validate" />
                                            <label for="password_confirmation">Repita a nova senha</label>
                                            @error('password_confirmation')
                                                <span class="helper-text red-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col s6 input-field no-margin-bottom">
                                            @if ($errors->updatePassword->any())
                                                <ul>
                                                    @foreach ($errors->updatePassword->all() as $error)
                                                        <li class="red-text">{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                        <div class="col s6 input-field no-margin-bottom right-align">
                                            <button type="submit" class="btn-small orange waves-effect redondo">
                                                <i class="fa fa-2x fa-arrows-rotate left"></i>
                                                Atualizar senha
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row no-margin-bottom container">
            <div class="col s12">
                <ul class="collapsible" id="collapsible_mapa">
                    <li>
                        <div class="collapsible-header">
                            <i class="default-icon-theme fa-duotone fa-regular fa-users-slash left"></i>
                            Exclusão da conta
                        </div>
                        <div class="collapsible-body">
                            <div class="row no-margin-bottom destaques">
                                <form method="POST" action="{{ route('destruir-conta') }}"
                                    onsubmit="return confirm('Tem certeza que deseja excluir sua conta?');">
                                    @csrf
                                    <div class="row no-margin-bottom">
                                        <div class="col m5 s12 input-field no-margin-bottom">
                                            <p>
                                                A exclusão da conta irá apagar seu usuário, bem como todos
                                                os users vinculados a ele.
                                            </p>
                                            <p class="red-text">
                                                ESTA OPERAÇÃO É IRREVERSÍVEL.
                                            </p>
                                        </div>
                                        <div class="col m4 s12 input-field no-margin-bottom">
                                            <input type="password" id="senha_atual" name="senha_atual"
                                                class="validate" />
                                            <label for="senha_atual">Senha atual</label>
                                            @error('senha_atual')
                                                <span class="helper-text red-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col m3 s12 input-field no-margin-bottom right-align">
                                            <button type="submit" class="btn-small red waves-effect redondo">
                                                <i class="fa fa-2x fa-arrows-rotate left"></i>
                                                Destruir conta
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>




    </main>
@endsection
