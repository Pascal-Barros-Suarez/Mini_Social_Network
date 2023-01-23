@extends('layouts.app')
@section('content')
<h1>Community</h1>
@foreach ($links as $link)
<li>{{$link->title}}</li>
@endforeach
{{$links->links()}}
@stop