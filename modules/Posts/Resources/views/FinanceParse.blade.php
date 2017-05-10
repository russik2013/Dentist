@extends('posts::layouts.master')

@section('content')

{{ print_r($parse) }}
<img src="{{asset($imgUrl)}}" >

@stop
