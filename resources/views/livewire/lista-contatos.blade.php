@inject('funcoes', 'App\Services\Funcoes')

<div>
    <input type="hidden" name="latitude" id="latitude" value="{{ floatval($user['latitude']) }}">
    <input type="hidden" name="longitude" id="longitude" value="{{ floatval($user['longitude']) }}">


    <div class="row titulo-mobile hide-on-med-and-up">
        <div class="col s12">
            <h5>Contatos</h5>
        </div>
    </div>

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

</div>
