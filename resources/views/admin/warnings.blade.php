@extends('_layout')

@section('content')
    <div class="headingmain">Admin</div>
    <div class="headingmain">Warnings:</div>

    @foreach( $warnings as $warning )
        {!! $warning !!}
    @endforeach
@endsection
