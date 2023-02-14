@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                @if ($links[0]->title == 'PHP' || $links[0]->title == 'Laravel' || $links[0]->title == 'React')
                    <h1 class="mt-2">Community - {{ $links[0]->title }}</h1>
                @else
                    <h1 class="mt-2">Community</h1>
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
