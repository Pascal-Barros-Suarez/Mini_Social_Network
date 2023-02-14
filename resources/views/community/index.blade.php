@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                @if ($channel)
                    <h1 class="mb-2 mt-2">Community - {{ $channel->title }}</h1>
                @else
                    <h1 class="mb-2 mt-2">Community</h1>
                @endif


                @if (count($links) == 0)
                    <h3>No contributions yet</h3>
                @else
                    @include('layouts.links')
                @endif
            </div>
            {{-- @include('../layouts/add-link'); --}}
            @include('layouts.add-link')

        </div>
        {{ $links->links() }}

    </div>


@stop
