    <ul class="pagination">
        <li class="{{ $paginator->onFirstPage() ? 'disabled' : '' }}">
            <a href="{{ $paginator->onFirstPage() ? '#!' : $paginator->previousPageUrl() }}">
                <i class="material-icons">chevron_left</i>
            </a>

            @foreach ($elements as $element)

                @if (is_string($element))
                    <li class="disabled">
                        {{ $element }}
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li class="{{ $page == $paginator->currentPage() ? 'active bg-primaria' : 'waves-effect'}}">
                            <a href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                @endif

            @endforeach

            <a href="{{ $paginator->hasMorePages() ? $paginator->nextPageUrl() : '#!' }}">
                <i class="material-icons">chevron_right</i>
            </a>

        </li>
    </ul>
