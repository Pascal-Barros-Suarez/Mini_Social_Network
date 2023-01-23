@extends('layouts.app')
@section('content')
    <h1>Community</h1>
    @foreach ($links as $link)
        <li>{{ $link->title }}
            <small>Contributed by: {{ $link->creator->name }}
                {{ $link->updated_at->diffForHumans() }}</small>
        </li>
    @endforeach
    {{ $links->links() }}
@stop
