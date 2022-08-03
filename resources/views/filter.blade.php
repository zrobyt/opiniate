@extends('layout.app')
@section('title')
{{ ucfirst($filter) }}
@endsection
@section('content')
    @include('layout.pollList',["polls"=>$polls])
@stop