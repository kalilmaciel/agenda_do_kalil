@extends('estrutura_externa')

@section('css_extra')
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
@endsection

{{--
Mostra uma mensagem de sucesso caso o envio
do e-mail tenha ocorrido corretamente
 --}}
@if (session('status'))
    @section('js_extra')
        <script>
            $(document).ready(function() {
                Aviso.fire({
                    icon: "error",
                    title: "E-mail enviado com sucesso!",
                });
            });
        </script>
    @endsection
@endif

@section('content')
    <main>

        <div id="login_page">
            <div
                class="z-depth-4 card-panel animate__animated animate__fadeInRightBig animate__delay-1s valign-wrapper no-margin">
                <form method="POST" action="{{ route('password.email') }}" onsubmit="carregando(true)">
                    @csrf
                    <div class="row no-margin-bottom">
                        <div class="input-field col s12 center no-margin-bottom">
                            <img src="{{ asset('assets/img/login-logo.png') }}" alt="" class="responsive-img">
                        </div>
                    </div>
                    <div class="row no-margin-bottom">
                        <div class="col s12">
                            <p>
                                Entre com seu e-mail para solicitar a alteração de senha.
                            </p>
                            <p>
                                Se o e-mail estiver correto, você receberá uma mensagem com um link para alteração de senha.
                            </p>
                        </div>
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
                        <div class="input-field col s12">
                            <button type="submit" class="btn btn-full waves-effect waves-light">
                                Solicitar
                            </button>
                        </div>
                        <div class="input-field col s12 center-align">
                            <a href="{{ route('login') }}" class="btn-flat btn-full waves-effect waves-light">
                                Voltar ao login
                            </a>
                        </div>
                    </div>
                    <div class="row no-margin-bottom">

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
