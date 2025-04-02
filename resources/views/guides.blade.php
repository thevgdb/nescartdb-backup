@extends('_layout')

@section('content')
    <div class="headingmain">Database Client Software 2.0 Manual</div>
    <img src="{{ asset('images/head_line.gif') }}" alt="" class="line"><b>Table of Contents:</b>
    <table class="textmain">
        <tr>
            <td align="left">
                <ul>
                    <li><a href="{{ route('guides.view', [ 'guide_key' => "settings" ]) }}">Program Setup</a>
                    <li><a href="{{ route('guides.view', [ 'guide_key' => "test" ]) }}">Testing CopyNES</a>
                    <li>
                        <a href="{{ route('guides.view', [ 'guide_key' => "require" ]) }}">Submission Requirements &amp; Guidelines</a>
                        <ul>
                            <li>
                                <a href="{{ route('guides.view', [ 'guide_key' => "adding" ]) }}">Adding a Cart to the DB</a>
                                <ul>
                                    <li><a href="{{ route('guides.view', [ 'guide_key' => "gameinfo" ]) }}">Entering new game data</a>
                                </ul>
                            <li>
                                <a href="{{ route('guides.view', [ 'guide_key' => "pcb" ]) }}">PCB Definition</a>
                                <ul>
                                    <li><a href="{{ route('guides.view', [ 'guide_key' => "img_win" ]) }}">PCB Scan Window</a>
                                </ul>
                            <li><a href="{{ route('guides.view', [ 'guide_key' => "props" ]) }}">Cart Properties</a>
                            <li>
                                <a href="{{ route('guides.view', [ 'guide_key' => "chips" ]) }}">Entering Chip Data</a>
                                <ul>
                                    <li><a href="{{ route('guides.view', [ 'guide_key' => "chip_id" ]) }}">How to ID a chip</a>
                                </ul>
                            <li><a href="{{ route('guides.view', [ 'guide_key' => "dump" ]) }}">Dumping the cart</a>
                        </ul>
                    <li><a href="{{ route('guides.view', [ 'guide_key' => "update" ]) }}">Updating a Profile</a>
                    <li><a href="{{ route('guides.view', [ 'guide_key' => "conv" ]) }}">Converting between file formats</a>
                    <li><a href="{{ route('guides.view', [ 'guide_key' => "repair" ]) }}">iNES Header Repair</a>
                </ul>
            </td>
        </tr>
    </table>
@endsection
