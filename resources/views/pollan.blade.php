@extends('layout.app')
@section('title','Poll Maker')
@php use App\Models\Polls; @endphp
@section('content')

@if ( (session()->has('name')) && (session()->get('email')==config("sets.superAdmin.email")) )

<div class='d-flex flex-wrap p-3'>

    @foreach(["Total Polls"=>count(Polls::all()),"Open Polls"=>count(Polls::where('status','=','open')->get()),"Closed Polls"=>count(Polls::where('status','=','closed')->get()),"Seedr"=>((config("sets.app.seedr"))?"On":"Off")] as $k=>$v)

    <div class='d-inline-flex p-2 col-lg-3 col-12'>
        <div class='w-100 p-4 shadow'>
            {{ $k }} <span class='float-end fw-bold text-success'>{{ $v }}</span>
        </div>
    </div>

    @endforeach

</div>

<div>
    <form id='add' onsubmit='binds()' action="/add" method='POST' class='d-flex flex-wrap w-100 p-3'>

        @csrf

        @foreach([
        "title"=>["Poll Title","String"],
        "link"=>["URL","String"],
        "preface"=>["Preface","String"],
        "loca"=>["Location","Global,Everywhere or Asia,India"],
        "subloca"=>["Sub-Location","Everywhere | TamilNadu,Chennai "],
        "year"=>["Year","2022"],
        "language"=>["Language","English | Tamil"],
        "category"=>["Category","Technology or Science or Politics or Health or Entertainment"],
        "subcate"=>["Sub-Category","Computers or Mobile or State or Social or Personal or Kollywood"],
        "tags"=>["Tags","tag1,tag2,..."],
        "binds"=>["Binds","bind1,bind2,..."],
        "options"=>["Options","opt1:count,optn2:count,..."],
        ] as $k=>$v)

        <div class='d-inline-flex col-lg-6 col-12'>
            <div class='p-2 w-100'>
                <div class='w-100'>
                    <label for="{{$k}}" class='p-2 fw-bold d-inline-block w-25'>{{$v[0]}}</label>
                    <input id='{{$k}}' name='{{$k}}' type="text" placeholder='{{$v[1]}}' class='w-100 d-inline-block border p-1 ps-3 pe-3' />
                </div>
            </div>
        </div>

        @endforeach
        <div id='binds' class='w-100 p-3 rounded mt-3 mb-3'></div>
        <input type="submit" value="Submit" class="bg-success ms-auto mt-auto me-5 text-white ms-2 m-4 p-1 ps-3 pe-3 rounded-pill">
    </form>
</div>

@else
<div class='w-100 text-center mt-5'>You donot have permission to view this page</div>
@endif

@stop