@extends('_layout')

@section('content')
    @if( !$img_src || strlen($img_src) == 0 )
        Invalid image request!
    @else
        <center><img src="{{ $img_src }}" alt="{{ $img_title }}" title="{{ $img_title }}" border="0"></center>
    @endif
@endsection
