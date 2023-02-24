@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if ($channel)
                    <h1 class="mb-2 mt-2 fs-2">Community - {{ $channel->title }}</h1>
                @else
                    <h1 class="mb-2 mt-2 fs-2">Community</h1>
                @endif

                <ul class="nav justify-content-center border-0">
                    <li class="nav-item border-0">
                        <a class="nav-link {{ request()->exists('popular') ? '' : 'disabled' }}"
                            href="{{ request()->url() }}">Most recent</a>
                    </li>
                    <li class="nav-item border-0">
                        <a class="nav-link {{ request()->exists('popular') ? 'disabled' : '' }}" href="?popular">Most
                            popular</a>
                    </li>
                </ul>



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
