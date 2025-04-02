@extends('_layout')

@section('content')
    <div class="headingmain">NES Cart Database</div>
    <div class="textsmall">&raquo; Someone make me a damn logo! :)</div>
    <img src="{{ asset('images/head_line.gif') }}" alt="" class="line">
    <p>Welcome, this site aims to document NES carts and detailed info about their hardware.</p>

    <table>
        @foreach( $updates as $update )
            <tr valign="top">
                <td class="headingmain" width="100%">{{ $update->getAttribute('title') }}</td>
            </tr>
            <tr>
                <td class="textsub">{{ $update->getAttribute('posted_at') }} :: <span style="font-weight: bold; color: yellow;">{{ $update->getAttribute('posted_by') }}</span></td>
            </tr>
            <tr>
                <td><img src="{{ asset('images/spacer.gif') }}" alt="" width="1" height="8" border="0"></td>
            </tr>
            <tr>
                <td class="textmain">
                    {!! $update->getAttribute('body_content') !!}
                </td>
            </tr>
            <tr>
                <td colspan="2"><img src="{{ asset('images/head_line.gif') }}" alt="" width="500" vspace="8" height="1" border="0"></td>
            </tr>
        @endforeach
    </table>
@endsection
