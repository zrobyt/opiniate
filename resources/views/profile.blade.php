@php
use App\Models\Gusers;
use App\Models\Polls;
use App\Models\UserVotes;
use App\Models\Follow;
use Coduo\PHPHumanizer\NumberHumanizer;
use App\Helpers\Math;

$guser = Gusers::where("id",$id)->get()->first();
$userVotes = UserVotes::where("uid",$id)->get();
$route = \Illuminate\Support\Facades\Route::currentRouteName();

$intr = (array)json_decode($guser->interests);
arsort($intr);
@endphp
@extends('layout.app')
@section('title',(($route=='opinion')?"Opinion":"Profile"))
@section('desc',$guser->name . (($route=='opinion')?"'s Opinion":"'s Opiniate.in Profile"))
@section('img',"/opiniate.png" )
@section('url',URL::current())
@section('content')

<div id='share' class='bg-white border p-1 ps-3 pe-3 rounded-pill float-end me-3' style='display:none;'>Share</div>

<div uid='{{ $id }}' class='d-flex w-100 justify-content-start flex-wrap'>

    <div class='pt-lg-4 col-12 col-lg-4 float-start'>

        <div class='d-inline-block align-top overflow-hidden p-4 w-100 text-nowrap'>

            <div class='w-100 shadow bg-white rounded overflow-hidden'>

                <img onerror='iRetry();' class='m-0 float-start' style='width:31%;' src="{{ $guser->pic }}" alt="" referrerpolicy="no-referrer">
                <div class='d-inline-block text-truncate fs-5 border-bottom text-success align-top m-0 p-1 ps-2 ' style='width:69% !important;'>
                    {{ $guser->name }}
                </div>
                <br>
                <div class='d-inline-block align-bottom text-truncate fs-6 text-muted fw-bold ps-3 pt-3' style='width:69%;'>
                    <div>Status : {{ $guser->bio }}</div>
                    <div>Votes : {{ Math::readable($guser->votes) }}</div>
                </div>

            </div>

        </div>

        <div id='viewFoll' class='d-inline-block align-top overflow-hidden p-2 pt-1 pb-1 w-100 text-nowrap'>
            @include('layout.viewFoll',["id"=>$id])
        </div>

        <div class='d-inline-block align-top w-100 h-50 overflow-hidden'>
            <div class='col-12 h-100 overflow-auto p-4 pt-0'>
                @foreach($intr as $k=>$v)
                <div class='w-100 mt-3 bg-white shadow rounded p-3 small'>
                    {{ $k ." : ". round($v*100/array_sum($intr)) . "%" }}

                    <div class='rounded bg-success mt-3' style='height:5px;width:{{ round($v*100/array_sum($intr)) }}%;'>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class='pt-3 pt-lg-4 col-12 col-lg-8 float-end'>

        @if(session()->get('id') !== (int)($id))
        @php
        $folls = Follow::where(["uid"=>session()->get('id'),"fid"=>(int)($id)])->exists();
        @endphp

        @if(session()->has('name'))
        <div follow='{{($folls)?"false":"true"}}' style='cursor:pointer;' class='float-end {{ ($folls)?"bg-white text-muted":"bg-success text-white" }} rounded-pill p-1 ps-3 pe-3 me-3'>
            {{ ($folls)?"Unfollow":"Follow" }}
        </div>
        @endif

        @endif
        <br>
        <div class='p-3 border-start'>

            <!-- <div>I stand with :
                @if (sizeof(json_decode($guser->stand))>0)

                @foreach(json_decode($guser->stand) as $s)
                <span class=''>{{$s}} @if($loop->last)@else,@endif</span>
                @endforeach

                @else None
                @endif

            </div> -->


            @if ($route=="opinion")
            <div>
                <ul class='list-unstyled d-flex justify-content-start flex-wrap'>
                    <div class='w-100 mb-4'><span class='fw-bold text-success'>Opinion</span> : <span class='text-muted'>Shared with you</span></div>
                    <div class='d-inline-block col-12 col-lg-6 mb-3'>
                        @include('layout.viewOpi',["userVotes"=>UserVotes::where('id',$uvid)->get(),"col"=>12,"comtr"=>false])
                    </div>
                </ul>
            </div>
            <hr>
            @endif

            <div>
                <ul class='list-unstyled d-flex justify-content-start flex-wrap'>
                    <div class='w-100 mb-4'><span class='fw-bold text-success'>Opinion{{ (sizeof($userVotes)>1)?"s":"" }}</span> : <span class='text-muted'>Recent</span></div>
                    @if(sizeof($userVotes)>0)
                    <div class='d-inline-block col-12 col-lg-6'>
                        @include('layout.viewOpi',["userVotes"=>$userVotes->reverse()->take(50)->take((round($userVotes->count()/2))),"col"=>12,"comtr"=>false])
                    </div>
                    <div class='d-inline-block col-12 col-lg-6'>
                        @include('layout.viewOpi',["userVotes"=>$userVotes->reverse()->take(50)->take(-(round($userVotes->count()/2))),"col"=>12,"comtr"=>false])
                    </div>
                    @else
                    No opinions made yet. Assert you opinion now.
                    @endif

                </ul>
            </div>
        </div>
    </div>
</div>

@endsection