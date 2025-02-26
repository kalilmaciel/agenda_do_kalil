<ul id="slide-out" class="sidenav sidenav-collapsible collapsible">
    <li>
        <div class="user-view">
            <div class="background" style="background-image: url({{ asset('assets/img/office.jpeg') }})">
            </div>
            <a href="{{ route('meu-cadastro') }}">
                <img class="circle" src="{{ session('image_location') . 'usuarios/t_' . session('user.imagem') }}">
            </a>
            <p class="white-text ">
                <i class="material-icons left">person_outline</i>
                {{ session('user')['name'] }}
            </p>
            <p class="white-text">
                <i class="material-icons left">mail</i>
                {{ session('user')['email'] }}
            </p>
            <form method="POST" action="{{ route('logout') }}" class="right">
                @csrf
                <button type="submit" class="btn-small waves-effect waves-light">
                    <i class="fas fa-power-off left"></i>
                    Sair
                </button>
            </form>
        </div>
    </li>
    <li>
        <a class="waves-effect waves-green  sidenav-close" href="{{ route('home') }}">
            <i class="fad default-icon-theme fa-2x fa-bookmark"></i>
            <span class="valign-wrapper">
                Home
            </span>
        </a>
    </li>

    <li>
        <div class="divider"></div>
    </li>
    <li>
        <a class="waves-effect waves-green sidenav-close" href="{{ route('meu-cadastro') }}">
            <i class="fad default-icon-theme fa-2x fa-user"></i>
            <span class="valign-wrapper">
                Meu cadastro
            </span>
        </a>
    </li>
    <li>
        <a class="waves-effect waves-green sidenav-close" href="{{ route('contatos') }}">
            <i class="fad default-icon-theme fa-2x fa-users"></i>
            <span class="valign-wrapper">
                Contatos
            </span>
        </a>
    </li>


    @if (session('user.permissao') == 99)
        <li>
            <a class="waves-effect waves-green sidenav-close" href="{{ route('listar-usuarios') }}">
                <i class="fad default-icon-theme fa-2x fa-users"></i>
                <span class="valign-wrapper">
                    Listar usuários
                </span>
            </a>
        </li>

        <li>
            <a class="waves-effect waves-green sidenav-close" href="{{ route('configuracoes') }}">
                <i class="fad default-icon-theme fa-2x fa-cog"></i>
                <span class="valign-wrapper">
                    Configurações
                </span>
            </a>
        </li>
    @endif

</ul>
