@extends('layout.app')
@section('title','Poll')
@section('desc',$poll->title)
@section('img',"https://www.opiniate.in/". (new \WebThumbnailer\WebThumbnailer())->maxHeight(280)->maxWidth(240)->crop(true)->thumbnail($poll->link) )
@section('url',URL::current())
@section('content')
    @include('layout.viewPoll',$poll)
@stop