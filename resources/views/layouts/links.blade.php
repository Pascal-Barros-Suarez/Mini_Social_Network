<ul>
    @foreach ($links as $link)
        <li>
            <div class="spaceInLi">
                <span class="text-span-in-li label label-default" style="background: {{ $link->channel->color }}">
                    {{ $link->channel->title }}
                </span>
                <a href="{{ $link->link }}" target="_blank">
                    {{ $link->title }}
                </a>
                <small>Contributed by: {{ $link->creator->name }}
                    {{ $link->updated_at->diffForHumans() }}</small>
            </div>
        </li>
    @endforeach
</ul>
