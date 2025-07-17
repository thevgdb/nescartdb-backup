@extends('_layout')

@section('content')

    @if( config('nescartdb.show_nescartdb_backup_application_welcome_message', true) )
        <div style="padding: 5px; background-color: #1f1f2d; border: 2px solid #363460; color: #FFF; text-align: center; font-size: 12px; margin-left: 25px; margin-right: 25px; margin-top: 25px; margin-bottom: 25px;">
            <h1 style="margin-top: 0px; margin-bottom: 0px;"><u>NESCartDB Backup</u></h1>
            <p style="margin-top: 10px; margin-bottom: 10px;">
                Hi, thank you for using this NESCartDB Backup web application project.
                This is a complete backup and re-implementation of the original NESCartDB project by BootGod and the NESDev Community (https://forums.nesdev.org/).
                Credit to them for making it.
                | <a href="{{ route('about') }}">More Information</a>.
                <br>To suppress this message permanently, edit the <code>show_nescartdb_backup_application_welcome_message</code> configuration value in <code>config/nescartdb.php</code>.
            </p>
        </div>
    @endif




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
