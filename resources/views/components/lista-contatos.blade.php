<ul class="collection lista-itens">
    @forelse ($lista as $contato)
        @include('templates/contato_item_lista', ['contato' => $contato])
    @empty
        @include('templates/vazio_item_lista')
    @endforelse
</ul>
