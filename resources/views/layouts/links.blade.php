<ul>
    @foreach ($links as $link)
        <li>
            <div class="spaceInLi">
                <span class="text-span-in-li label label-default" style="background: {{ $link->channel->color }}">
                    <a href="/community/{{ $link->channel->slug }}" target="_blank">
                        {{ $link->channel->title }}
                    </a>
                </span>
                <a class="enlace" href="{{ $link->link }}" target="_blank">
                    {{ $link->title }}
                </a>
                <small>Contributed by: {{ $link->creator->name }}
                    {{ $link->updated_at->diffForHumans() }}</small>
                <br>

                <div>
                    <form method="POST" action="community/votes/{{ $link->id }}">
                        {{ csrf_field() }}
                        <button
                            class="ms-4 me-2 m-1 btn btn-sm {{ Auth::check() && Auth::user()->votedFor($link) ? 'btn-success' : 'btn-primary' }}"
                            {{ Auth::user()->trusted ? '' : 'disabled' }}>
                            {{-- {{ Auth::guest() ? 'disabled' : '' }}> --}}
                            👍
                        </button>

                        <small>🎇votos: {{ $link->users()->count() }}</small>
                    </form>
                </div>
            </div>
        </li>
    @endforeach
</ul>
{{ $links->appends($_GET)->links() }}
{{-- La función appends se encarga de mantener los filtros seleccionados al navegar por las diferentes páginas del sistema de paginación de Laravel. --}}
