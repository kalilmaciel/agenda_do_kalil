<nav role="navigation" class="menu-superior">
    <div class="nav-wrapper">

        <a href="#" data-target="slide-out" class="sidenav-trigger show-on-large button-menu "
            id="menu_lateral_principal">
            <i class="material-icons prefix">menu</i>
        </a>

        <a id="logo-container" href="{{ route('home') }}" class="brand-logo">
            <img src="{{ asset('assets/img/logo-titulo.png') }}" />
        </a>

    </div>
</nav>

@isset($breadcrumb)
    <nav class="sub-titulo hide-on-small-and-down bg-primaria">
        <div class="nav-wrapper">
            <div class="row">
                <div class="col s8">
                    @foreach ($breadcrumb as $k => $b)
                        @php
                            if (is_numeric($k)) {
                                $link = '#!';
                            } else {
                                $link = "/$k";
                            }
                        @endphp
                        <a href='{{$link}}' class='breadcrumb'>{{$b}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </nav>
    @endif
