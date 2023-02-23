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
                    <form method="POST" action="/votes/{{ $link->id }}">
                        {{ csrf_field() }}
                        <button type="button" class="ms-4 m-1 btn btn-success btn-sm"
                            {{ Auth::guest() ? 'disabled' : '' }}>
                            👍
                        </button>
                        <small>🎇votos: {{ $link->users()->count() }}</small>
                    </form>
                </div>
            </div>
        </li>
    @endforeach
</ul>
