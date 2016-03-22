@extends('templates.master')


@section('content')
<a href="{{URL::to('administrator/user')}}">new user</a><br/>
<a href="{{URL::to('administrator/doctor')}}">doctor</a><br/>
<a href="{{URL::to('administrator/ward')}}">ward</a><br/>
<a href="{{URL::to('administrator/rfrcs')}}">refer cause</a><br/>
<a class="hide" href="{{URL::to('administrator/prefix')}}">prefix</a><br/>
@endsection