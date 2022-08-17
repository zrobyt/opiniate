@extends('layout.app')
@section('title','Home')
@section('desc','Assert your Opinion')
@section('img','/opiniate.png')
@section('url',URL::current())
@section('content')

<div class='fs-4 m-2 m-lg-3 text-success'>Assert your opinion<br>
    <span class='fs-6 text-muted'>Cast your Vote now and Take a Stand.</span>
</div>

@php
use App\Models\Polls;
use App\Models\UserVotes;
use App\Models\Gusers;
use App\Models\Follow;
$topics = ["Recent Polls"=>["recent",$latest],"Top Trending Polls"=>["trending",$top]];
@endphp

@php

if (session()->has('name'))
{
$fid = Follow::where('uid',session()->get("id"))->get()->pluck('fid');
$uv = UserVotes::whereIn("uid",$fid)->where('comment',"!=","")->orderBy('created_at',"DESC")->get();
}
else
{
$uv = UserVotes::latest()->limit(6)->get();
}

@endphp
@if(($uv->count())>0)
<div class="d-inline-block p-1 col-lg-12 col-12">
    <div class='text-muted fs-5 p-2'><span class='text-success'>&nbsp★ </span>Opinions</div>
    <div class='d-inline-block float-start col-lg-4'>
        @include('layout.viewOpi',["userVotes"=>$uv->slice(0,1)->merge($uv->slice(3,1)),"col"=>12,"comtr"=>true])
    </div>
    <div class='d-inline-block col-lg-4 '>
        @include('layout.viewOpi',["userVotes"=>$uv->slice(1,1)->merge($uv->slice(4,1)),"col"=>12,"comtr"=>true])
    </div>
    <div class='d-inline-block float-end col-lg-4 '>
        @include('layout.viewOpi',["userVotes"=>$uv->slice(2,1)->merge($uv->slice(5,1)),"col"=>12,"comtr"=>true])
    </div>
</div>
@endif

@foreach( $topics as $k=>$v)
<div class='p-1'>
    <div class='text-muted fs-5 p-2 w-100'>
        <span class='float-start'>
            <span class='text-success'>&nbsp★ </span>{{ $k }}
        </span>
        <span class='float-end fs-6 me-2 rounded-pill bg-white fw-bold border ps-3 pe-3 '>
            <a class='small' href='/{{$v[0]}}'>View</a>
        </span>
    </div>
    <div class='col-12 mt-5'>
        @include('layout.pollList',["polls"=>$v[1]])
    </div>
</div>
@endforeach

@stop