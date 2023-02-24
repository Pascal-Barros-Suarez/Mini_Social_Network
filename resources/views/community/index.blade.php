@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="container-fluid">
                    <form action="community" role="search" method="GET" class="flex me-4">
                        @if ($channel)
                            <h1 class="mb-2 mt-2 fs-2 justify-content-start">Community - {{ $channel->title }}</h1>
                        @else
                            <h1 class="mb-2 mt-2 fs-2 justify-content-start">Community</h1>
                        @endif
                        <div class="input-group mt-1 justify-content-end">
                            <input type="search" id="form1" name="search"
                                placeholder="{{ $search ? $search : 'Search...' }}" value="{{ $search ? $search : '' }}"
                                class="border border-1 rounded-start" />

                            <button type="submit" class="btn btn-primary bg-primary">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <br>
                <ul class="nav justify-content-center border-0">
                    <li class="nav-item border-0">
                        <a class="nav-link {{ request()->exists('popular') ? '' : 'disabled' }}"
                            href="{{ request()->url() }}">
                            <i class="bi bi-clock-history"> Most recent</i></a>
                    </li>
                    <li class="nav-item border-0">
                        <a class="nav-link {{ request()->exists('popular') ? 'disabled' : '' }}" href="?popular">
                            <i class="bi bi-fire"> Most popular</i></a>
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
