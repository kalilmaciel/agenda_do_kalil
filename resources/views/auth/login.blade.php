@extends('estrutura_externa')

@section('css_extra')
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
@endsection

@section('content')
    <main>

        <div id="login_page">
            <div
                class="z-depth-4 card-panel animate__animated animate__fadeInRightBig animate__delay-1s valign-wrapper no-margin">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="row no-margin-bottom">
                        <div class="input-field col s12 center no-margin-bottom">
                            <img src="{{ asset('assets/img/login-logo.png') }}" alt="" class="responsive-img">
                        </div>
                    </div>
                    <div class="row no-margin-bottom">
                        <div class="input-field col s12 no-margin-bottom">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="email" name="email" type="text" value="{{ old('email') }}">
                            <label for="email" class="center-align">E-mail</label>
                            @error('email')
                                <span class="helper-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row no-margin-bottom">
                        <div class="input-field col s12 no-margin-bottom">
                            <i class="material-icons prefix">lock_open</i>
                            <input id="password" name="password" type="password" autocomplete="off">
                            <label for="password">Senha</label>
                            <i class="fas olho fa-eye"></i>
                            @error('password')
                                <span class="helper-text red-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row no-margin-bottom">
                        <div class="input-field col s12">
                            <button type="submit" class="btn btn-full waves-effect waves-light">
                                Entrar
                            </button>
                        </div>
                    </div>
                    <div class="row no-margin-bottom">
                        <div class="input-field col s12">
                            <a href="{{ route('register') }}" class="btn btn-full waves-effect waves-light">
                                Novo Cadastro
                            </a>
                        </div>
                        {{-- <div class="input-field col s12 center-align">
                            <a href="{{ route('forgot-password') }}" class="btn-flat btn-full waves-effect waves-light">
                                Recuperação de senha
                            </a>
                        </div> --}}

                        <div class="input-field col s12 center-align no-margin-bottom">
                            <small>
                                Um produto de <a href="http://meusnegocios.com.br">Meus Negócios</a>.
                            </small>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </main>
@endsection
