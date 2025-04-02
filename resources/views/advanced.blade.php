@extends('_layout')

@section('content')
    <div class="headingmain">Search Results</div>
    <img src="/images/head_line.gif" alt="" class="line">
    <p class="textsmall">
        {{ $carts->onEachSide(4)->links('_paginator') }}
        <br>
    </p>
    <table id="srtbl" cellspacing="0" cellpadding="2" class="simboxcontent">
        <tr class="header">
            <td><img id="img_parent" src="{{ asset('images/plus.gif') }}" width="9" height="9" border="0" alt="Expand all" onclick="display_all_rows(true);"></td>
            <td nowrap>
                <a class="header" href="?keywords=&amp;browse=Z&amp;field=1&amp;order=desc"><span title="Sort by Region">R</span></a>
            </td>
            <td align="left" nowrap>
                <a class="header" href="?keywords=&amp;browse=Z&amp;field=2&amp;order=desc"><span title="Sort by Game Title">Game Title</span></a>
                &nbsp;<img src="{{ asset('images/alert_up.gif') }}" width="9" height="9" alt="Ascending" border="0">
            </td>
            <td nowrap>
                <a class="header" href="?keywords=&amp;browse=Z&amp;field=11&amp;order=desc"><span title="Sort by Publisher">Publisher</span></a>
            </td>
            <td nowrap>
                <a class="header" href="?keywords=&amp;browse=Z&amp;field=3&amp;order=desc"><span title="Sort by Catalog ID">Catalog ID</span></a>
            </td>
            <td nowrap>
                <a class="header" href="?keywords=&amp;browse=Z&amp;field=9&amp;order=desc"><span title="Sort by PCB Name">PCB Name</span></a>
            </td>
            <td nowrap>
                <a class="header" href="?keywords=&amp;browse=Z&amp;field=20&amp;order=desc"><span title="Sort by Submitter">Submitter</span></a>
            </td>
            <td nowrap>
                <a class="header" href="?keywords=&amp;browse=Z&amp;field=41&amp;order=desc"><span title="Sort by Submission Date">Submitted</span></a>
            </td>
            <td nowrap>
                <a class="header" href="?keywords=&amp;browse=Z&amp;field=53&amp;order=desc"><span title="Sort by Cart Verified #">C x !</span></a>
            </td>
        </tr>

        <?php $current_count = 0; ?>
        @foreach( $carts as $cart )
            <?php $current_count++; ?>

            <tr id="c{{ $cart->getAttribute('cart_id') }}" class="{{ ($current_count % 2 == 1 ? 'odd' : 'even') }}">
                <td>&nbsp;</td>
                <td class="textmain" align="center" nowrap>
                    @include('_region_flag', ['region' => $cart->getAttribute('region')])
                </td>
                <td style="width: 100%; white-space: normal; text-align:left;">
{{--                    <a class="result" href="/profile/view/{{ $cart->getAttribute('cart_id') }}/{{ $cart->getAttribute('cart_url_slug') }}" title="View the database profile for this game">{{ $cart->getAttribute('game_title') }}</a>--}}
                    <a class="result" href="{{ route('cart', ['cart_id' => $cart->getAttribute('cart_id'), 'cart_url_slug' => $cart->getAttribute('cart_url_slug')]) }}" title="View the database profile for this game">{{ $cart->getAttribute('game_title') }}</a>
                    @if( strlen($cart->getAttribute('game_version')) > 0 )
                        &nbsp;<span class="headingsubtitle" style="font-size: 12px">({{ $cart->getAttribute('game_version') }})</span>
                    @endif
                    @if( strlen($cart->getAttribute('game_subtitle')) > 0 )
                        &nbsp;<span class="headingsubtitle" style="font-size: 12px">{{ $cart->getAttribute('game_subtitle') }}</span>
                    @endif
                </td>
                <td class="textmain" align="center" nowrap>
                    <a class="result" href="/search/advanced?publisher={{ $cart->getAttribute('publisher') }}" title="Search for other games by this Publisher">{{ $cart->getAttribute('publisher') }}</a>
                </td>
                <td class="textsmall" align="center">{{ $cart->getAttribute('catalog_id') }}</td>
                <td class="textmain" align="center" nowrap>{{ $cart->getAttribute('pcb_name') }}</td>
                <td class="textmain" align="center" nowrap>{{ $cart->getAttribute('submitter') }}</td>
                <td class="datetime" align="center" style="font-size: 12px">{{ $cart->getAttribute('submitted')->format('Y-m-d') }}</td>
                <td class="textmain" align="center" nowrap>{{ $cart->getAttribute('number_of_times_cart_verified') }}</td>
            </tr>
        @endforeach
    </table>
@endsection
