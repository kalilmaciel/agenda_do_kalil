@inject('funcoes', 'App\Services\Funcoes')

@extends('estrutura_interna')

@section('content')
    <main>

        <div class="bem-vindo container">

            <div class="row">
                <div class="col s12">
                    <div class="row no-margin-bottom">
                        <div class="col s12 center-align">
                            @if (session('user.permissao') == 99)
                                <a class="card botoes-inicial animate__animated animate__fadeIn delay_3"
                                    href="{{ route('listar-usuarios') }}">
                                    <div class="card-content">
                                        <div>
                                            <div class="row no-margin-bottom">
                                                <div class="col s12">
                                                    <i class="fad default-icon-theme fa-2x fa-users"></i>
                                                </div>
                                            </div>
                                            <div class="row no-margin-bottom">
                                                <div class="col s12">
                                                    <h5>
                                                        Listagem de usuarios
                                                    </h5>
                                                    <small>
                                                        Veja os usuários cadastrados
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @else
                                <a class="card botoes-inicial animate__animated animate__fadeIn delay_3"
                                    href="{{ route('contatos') }}">
                                    <div class="card-content">
                                        <div>
                                            <div class="row no-margin-bottom">
                                                <div class="col s12">
                                                    <i class="fad default-icon-theme fa-2x fa-users"></i>
                                                </div>
                                            </div>
                                            <div class="row no-margin-bottom">
                                                <div class="col s12">
                                                    <h5>
                                                        Meus contatos
                                                    </h5>
                                                    <small>
                                                        Veja e altere seus contatos
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </main>
@endsection
