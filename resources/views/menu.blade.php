@php use App\Models\Polls; @endphp
@extends('layout.app')
@section('title','Menu')
@section('desc','Assert your Opinion')
@section('img','/opiniate.png')
@section('url',URL::current())
@section('content')

@php
$mlist = [
"General"=>[
"Home"=>"/",
"Recent"=>"/recent",
"Trending"=>"/trending",
],
"Languages"=>array_combine(Polls::languages(),array_map(function($v){return "/language/".$v;} , Polls::languages())),
"Categories"=>array_combine(Polls::categories(),array_map(function($v){return "/category/".$v;} , Polls::categories())),
"Sub Categories"=>array_combine(Polls::subcategories(),array_map(function($v){return "/category/".$v;} , Polls::subcategories())),
"Regions"=>array_combine(Polls::regions(),array_map(function($v){return "/place/".$v;} , Polls::regions())),
"Nations"=>array_combine(Polls::nations(),array_map(function($v){return "/place/".$v;} , Polls::nations())),
"States"=>array_combine(Polls::states(),array_map(function($v){return "/place/".$v;} , Polls::states())),
"Cities"=>array_combine(Polls::cities(),array_map(function($v){return "/place/".$v;} , Polls::cities())),
"Years"=>array_combine(Polls::years(),array_map(function($v){return "/year/".$v;} , Polls::years())),
];

if (session()->has('name'))
{
  $mlist['General'] = array_merge($mlist['General'],["Profile"=>"/profile"]);

  if (session()->get('email')==config("sets.superAdmin.email"))
  {
    $mlist['General'] = array_merge($mlist['General'],["Poll Maker"=>"/polls"]);
  }

}

$mlist['General'] = array_merge($mlist['General'],['Privacy Policy'=>'/privacy','Android App'=>'https://play.google.com/store/apps/details?id=in.opiniate.www']);

if (session()->has('name'))
{
  $mlist['General'] = array_merge($mlist['General'],["SignOut"=>"/signout"]);
}

@endphp

<div class='w-100 p-2'>

    <div class='d-inline-block align-top col-12 col-lg-3 p-lg-3 m-lg-4'>

        @foreach($mlist as $mc => $mv)
        <div class='d-inline-block bg-white border-bottom rounded align-top shadow col-12'>
            <div class='menuType w-100 p-2 ps-3 border-bottom {{ ($mc=="General")?"bg-success text-white ":"bg-light text-dark " }}'  style='cursor:pointer;'>
                <span class=''>{{ $mc }}</span>
            </div>

            <ul class='menuList mt-2 {{ ($mc=="General")?"gnrl":"" }}' style="list-style-type:square;">
                @foreach($mv as $m => $l)
                <li class='small p-2'>
                    <a href="{{ $l }}">
                        {{ $m }}
                    </a>
                </li>
                @endforeach
            </ul>

        </div>
        @endforeach
        <script>
            $('.menuType').on('click', function() {
                $(this).next().delay(200).slideToggle(250);
                $(this).parent().siblings().children('.menuList').slideUp(200);
            });
        </script>
        <style>
            .menuList {
                display: none;
            }

            .menuList.gnrl {
                display: block;
            }
        </style>
    </div>

    <div class='d-inline-block align-top col-12 col-lg-8 mt-4 mt-lg-4 ms-lg-3 p-lg-2'>
        <div class='fw-bold'>Tags : </div>

            @foreach(Polls::tags() as $k => $ts)
            <div class='mt-3 rounded bg-white shadow'>
                <div class='p-2 bg-light border-bottom'>{{ $k }}</div>
                <div class='p-2 bg-white'>
                @foreach($ts as $t)
                    <div class='d-inline-block me-1 mb-2 mt-2 small p-1 ps-2 pe-3 rounded bg-white border'>
                        <a class='' href="/tag/{{$t}}"> •&nbsp&nbsp{{ $t }}</a>
        </div>
                @endforeach
                </div>
            </div>
            @endforeach

    </div>

</div>
@stop