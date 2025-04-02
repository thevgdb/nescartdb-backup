@extends('_layout')

@section('content')
    <div class="headingmain">CopyNES Plugins</div>

    <img src="{{ asset('images/head_line.gif') }}" alt="" class="line"/>

    <table class="simboxcontent" cellspacing="0">
        <tr class="header">
            <th>Plugin</th>
            <th>Description</th>
            <th>Author(s)</th>
            <th>PRG</th>
            <th>CHR</th>
            <th>WRAM</th>
            <th>Version</th>
            <th>Created</th>
            <th>Notes / Change Log</th>
        </tr>
        @foreach( $plugins as $plugin )
            <tr class="{{ ($loop->odd) ? 'odd' : 'even' }}">
                <td align="center" nowrap>
                    <a class="result" href="{{ asset( 'storage/plugins/' . strtolower($plugin->getAttribute('filename')) ) }}">{{ $plugin->getAttribute('filename') }}</a>
                </td>
                <td style="white-space: normal;">{{ $plugin->getAttribute('description') }}</td>
                <td align="center" nowrap>{{ $plugin->getAttribute('authors') }}</td>
                <td align="center" nowrap>{!! (strlen($plugin->getAttribute('prg')) > 0 ? $plugin->getAttribute('prg') : '<span class="textna">NA</span>') !!}</td>
                <td align="center" nowrap>{!! (strlen($plugin->getAttribute('chr')) > 0 ? $plugin->getAttribute('chr') : '<span class="textna">NA</span>') !!}</td>
                <td class="center" nowrap>{!! (strlen($plugin->getAttribute('wram')) > 0 ? $plugin->getAttribute('wram') : '<span class="textna">NA</span>') !!}</td>
                <td align="center">{{ $plugin->getAttribute('version') }}</td>
                <td class="datetime">{{ $plugin->getAttribute('created')->format('Y/m/d') }}</td>
                <td style="white-space: normal;">{{ $plugin->getAttribute('notes') }}</td>
            </tr>
        @endforeach
    </table>

@endsection
