@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>Community</h1>
                @if (count($links) == 0)
                    <h3>No contributions yet</h3>
                @else
                    @foreach ($links as $link)
                        <li>
                            <span class="label label-default" style="background: {{ $link->channel->color }}">
                                {{ $link->channel->title }}
                            </span>
                            <a href="{{ $link->link }}" target="_blank">
                                {{ $link->title }}
                            </a>
                            <small>Contributed by: {{ $link->creator->name }}
                                {{ $link->updated_at->diffForHumans() }}</small>
                        </li>
                    @endforeach
                @endif
            </div>
            {{-- @include('../layouts/add-link'); --}}
            @include('layouts.add-link');

        </div>
        {{ $links->links() }}

    </div>


@stop
