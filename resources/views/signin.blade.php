@extends('layout.app')
@section('title','SignIn')
@section('content')
    <form action="/login" method='POST' class='p-5 p-lg-3'>
        @csrf
        <div class='fs-4 w-100 text-center text-success mb-5 mt-5'>SignIn</div>
        <div class='col-lg-3 col-12 ms-auto me-auto text-wrap'>
            @foreach(["email"=>"Email Address","password"=>"Password","confirmPassword"=>"Confirm Password"] as $k=>$v)
            <div class='w-100 mt-3 {{ ($k=="confirmPassword")?"d-none":"" }}'>
                <label for="{{$k}}" class='mb-2 text-muted'>{{$v}}</label>
                <input id='{{$k}}' name='{{$k}}' type="{{ ($k=='email')?'email':'text' }}" class='p-1 ps-3 pe-3 border w-100'>
            </div>
            @endforeach
            <input type="submit" value="Submit" class="bg-success text-white float-end mt-4 p-1 ps-3 pe-3 rounded-pill">

        </div>
    </form>
@stop
