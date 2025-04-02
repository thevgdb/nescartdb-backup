@extends('_layout')

@section('content')
    <div class="headingmain">Database Client Software 2.0 Manual</div>
    <div class="textsmall">&raquo; {{ $guide->getAttribute('title') }}{!! strlen($guide->getAttribute('menu')) > 0 ? "&nbsp;&nbsp;&nbsp;(" . $guide->getAttribute('menu') . ")" : "" !!}</div>
    <img src="{{ asset('images/head_line.gif') }}" alt="" class="line">
    {!! $guide->getAttribute('body_content') !!}
@endsection
