@extends('templates.master')


@section('content')
{{json_encode(Sentry::getUser())}}
@endsection