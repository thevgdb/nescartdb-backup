@extends('_layout')

@section('content')
    <div class="headingmain">Missing Games</div>
    <img src="{{ asset('images/head_line.gif') }}" alt="" class="line">
    <p class="textsmall">Number of matching missing games: {{ $missing_carts->count() }}</p>
    <table id="srtbl" cellspacing="0" cellpadding="2" class="simboxcontent">
        <tr class="header">
            <td><img id="img_parent" src="{{ asset('images/plus.gif') }}" width="9" height="9" border="0" alt="Expand all" onclick="display_all_rows(true);"></td>
            <td  nowrap>
                <a class="header" href=""><span title="Sort by Region">R</span></a>
            </td>
            <td  nowrap>
                <a class="header" href=""><span title="Sort by Catalog ID">Catalog ID</span></a>
            </td>
            <td align="left" nowrap>
                <a class="header" href=""><span title="Sort by Game Title">Game Title</span></a>
            </td>
            <td  nowrap>
                <a class="header" href=""><span title="Sort by Release Date">Released</span></a>
            </td>
            <td  nowrap>
                <a class="header" href=""><span title="Sort by Publisher">Publisher</span></a>
            </td>
            <td  nowrap>
                <a class="header" href=""><span title="Sort by System">System</span></a>
            </td>
            <td  nowrap>
                <a class="header" href=""><span title="Sort by Class">Class</span></a>
            </td>
        </tr>
        <?php $current_count = 0; ?>
        @foreach( $missing_carts as $missing_cart )
            <?php $current_count++; ?>
            <tr id="c" class="{{ ($current_count % 2 == 1 ? 'odd' : 'even') }}">
                <td>&nbsp;</td>
                <td class="textmain" align="center" nowrap>
                    @include('_region_flag', ['region' => $missing_cart->getAttribute('region')])
                </td>
                <td class="textsmall" align="center">{{ $missing_cart->getAttribute('catalog_id') }}</td>
                <td style="width: 100%; white-space: normal; text-align:left;">
                    <span class="nolink">{{ $missing_cart->getAttribute('game_title') }}</span>
                    @if( strlen($missing_cart->getAttribute('game_subtitle')) > 0 )
                        &nbsp;<span class="headingsubtitle" style="font-size: 12px">{{ $missing_cart->getAttribute('game_subtitle') }}</span>
                    @endif
                </td>
                <td class="datetime" align="center" style="font-size: 12px">{{ $missing_cart->getAttribute('released') }}</td>
                <td class="textmain" align="center" nowrap>
                    <span class="nolink">{{ $missing_cart->getAttribute('publisher') }}</span>
                </td>
                <td class="textmain" align="center" nowrap>{{ $missing_cart->getAttribute('system') }}</td>
                <td class="textmain" align="center" nowrap>{{ $missing_cart->getAttribute('class') }}</td>
            </tr>
        @endforeach
    </table>
@endsection
