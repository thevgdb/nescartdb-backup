<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
{{--    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-179299143-1"></script>--}}
{{--    <script>--}}
{{--        window.dataLayer = window.dataLayer || [];--}}
{{--        function gtag(){dataLayer.push(arguments);}--}}
{{--        gtag('js', new Date());--}}
{{--        gtag('config', 'UA-179299143-1');--}}
{{--    </script>--}}

{{--    <title>{{ (isset($page_title) && is_string($page_title) && strlen($page_title) > 0 ? $page_title : "NesCartDB - Home") }}</title>--}}
    <title>{{ (isset($page_title) && is_string($page_title) && strlen($page_title) > 0 ? $page_title : "NesCartDB") }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="{{ asset('css/main2f49.css?20201004') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/tooltip.css') }}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{ asset('js/nesdb2a15.js?20200930') }}"></script>
    <script type="text/javascript" src="{{ asset('js/tooltip.js') }}"></script>
</head>
<body onload="detectBrowser()">
<a name="top"></a>
<div class="header">
    <table class="header">
        <tr>
            <td width="100%">
                [<a href="{{ route('welcome') }}">Home</a>]
                [<a href="{{ route('search') }}">Search</a>]
                <!-- [<a href="software.php">Software</a>] -->
                [<a href="{{ route('guides') }}" title="Work in Progress">Guides</a>]
                [<a href="{{ route('plugins') }}" title="Download CopyNES plugins">Plugins</a>]
                <!--[<a href="xml.php" title="Download the most recent XML">XML</a>] -->
                [<a href="{{ route('missing') }}" title="View games missing from database">Missing</a>]
                <!--[<a href="pcb.php" title="View PCB info and stats">PCBs</a>] -->
                <!--[<a href="stats.php" title="View various real-time stats">Stats</a>] -->
                <!--[<a href="contrib.php">Contributors</a>] -->
            </td>
            <noscript>
                <td nowrap>You need JavaScript enabled (and cookies) to properly use this site!</td>
            </noscript>
            <td nowrap>
                @if( config('nescartdb.user_authentication_enabled', false) )

{{--                    @if( Auth::check() )--}}
{{--                        User: {{ Auth::user()->getAttribute('name') }}--}}
{{--                    @else--}}
{{--                        User: Guest--}}
{{--                    @endif--}}



{{--                    User: {{ Auth::check() ? Auth::user()->getAttribute('name') : 'Guest' }}--}}
{{--                    @if( Auth::check() )--}}
{{--                        [<a href="{{ route('logout') }}">Logout</a>]--}}
{{--                    @else--}}
{{--                        [<a href="{{ route('login') }}">Login</a>]--}}
{{--                        [<a href="{{ route('register') }}">Register</a>]--}}
{{--                    @endif--}}

                @endif
            </td>
        </tr>
    </table>
</div>
<br>
<div class="sidebar">
    <table class="sidebox">
        <tr class="header">
            <td nowrap>
                <a href="{{ route('search.advanced') }}" title="Click here to browse the database">Browse Database</a>
            </td>
        </tr>
        <tr>
            <td>
                <table class="sideboxcontent">
                    <tr class="textsmall">
                        <td>
                            <table width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center">
                                        <div class="textsmall">
                                            @foreach( str_split("@ABCDEFGHIJKLMNOPQRSTUVWXYZ") as $current_letter )
                                                |<a href="{{ route('search.browse', ['letter' => strtolower($current_letter)]) }}"> {{ ($current_letter == "@" ? '#' : $current_letter) }} </a>
                                            @endforeach
{{--                                            |<a href="{{ route('search.browse', ['letter' => '@']) }}"> # </a>|<a href="search/browse/a.html"> A </a>|<a href="search/browse/b.html"> B </a>|<a href="search/browse/c.html"> C </a>|<a href="search/browse/d.html"> D </a>|<a href="search/browse/e.html"> E </a>|<a href="search/browse/f.html"> F </a>|<a href="search/browse/g.html"> G </a>|<a href="search/browse/h.html"> H </a>|<a href="search/browse/i.html"> I </a>|<a href="search/browse/j.html"> J </a>|<a href="search/browse/k.html"> K </a>|<a href="search/browse/l.html"> L </a>|<a href="search/browse/m.html"> M </a>|<a href="search/browse/n.html"> N </a>|<a href="search/browse/o.html"> O </a>|<a href="search/browse/p.html"> P </a>|<a href="search/browse/q.html"> Q </a>|<a href="search/browse/r.html"> R </a>|<a href="search/browse/s.html"> S </a>|<a href="search/browse/t.html"> T </a>|<a href="search/browse/u.html"> U </a>|<a href="search/browse/v.html"> V </a>|<a href="search/browse/w.html"> W </a>|<a href="search/browse/x.html"> X </a>|<a href="search/browse/y.html"> Y </a>|<a href="search/browse/z.html"> Z </a>--}}
                                                |<a href="{{ route('search.random') }}"> Random Game </a>|
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <table class="sidebox">
        <tr class="header">
            <td nowrap>Quick Search</td>
        </tr>
        <tr>
            <td>
                <table class="sideboxcontent">
                    <tr class="textsmall">
                        <td>
                            <form action="{{ route('search.basic') }}" method="get">
                                <table width="100%" cellspacing="0" cellpadding="1">
                                    <tr>
                                        <td nowrap>
                                            <input type="text" name="keywords" style="height: 16px; width: 100px;">
                                        </td>
                                        <td>
                                            <input class="button" type="submit" value="Go">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <select name="kwtype" style="width: 144px;">
                                                <option value="game">Titles, Catalog ID</option>
                                                <option value="pcb">PCB, Class, Mapper</option>
                                                <option value="chip">Part#, Chip Type</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="textsmall" colspan="2">&raquo; <a href="{{ route('search') }}">Advanced Search</a></td>
                                    </tr>
                                </table>
                            </form>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <table class="sidebox">
        <tr class="header">
            <td nowrap>
                <a href="{{ route('search.advanced', [ 'group' => 'cartid', 'field' => '41', 'order' => 'desc', 'rows' => '25' ]) }}" title="Search for the latest profiles">Latest Dumps</a>
            </td>
        </tr>
        <tr>
            <td>
                <table class="sideboxcontent">
                    <tr class="textsmall">
                        <td>
                            @if( !is_null($latest_dumps) )

                                @foreach( $latest_dumps as $latest_dump )
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td class="datetime">{{ $latest_dump->getAttribute('submitted') }}</td>
                                        </tr>
                                        <tr>
                                            <td width="100%" class="textsmall">
                                                <a href="{{ $latest_dump->publicUrl() }}">{{ $latest_dump->getAttribute('game_title') }}</a>
                                            </td>
                                            <td>
                                                {!! render_flag_html( $latest_dump->getAttribute('region') ) !!}
                                            </td>
                                        </tr>
                                    </table>
                                    <hr>
                                @endforeach

                            @endif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <table class="sidebox">
        <tr class="header">
            <td nowrap><a href="{{ route('stats') }}">Database Stats</a></td>
        </tr>
        <tr>
            <td>
                <table class="sideboxcontent">
                    <tr class="textsmall">
                        <td>
                            &raquo; Cart Profiles: <span class="datetime">{{ Schema::hasTable('carts') ? number_format(App\Models\Cart::count()) : '0' }}</span><br>
                            &raquo; Unique Games: <span class="datetime">{{ Schema::hasTable('unique_games') ? number_format(App\Models\UniqueGame::count()) : '0' }}</span><br>
                            &raquo; Images: <span class="datetime">{{ Schema::hasTable('cart_images') ? number_format(App\Models\CartImage::count()) : '0' }}</span><br>
                            &raquo; Contributors: <span class="datetime">{{ Schema::hasTable('users') ? number_format(App\Models\User::count()) : '0' }}</span><br>
{{--                          &raquo; Unique PCBs: <span class="datetime">628</span><br>--}}
{{--                          &raquo; Unique ROMs: <span class="datetime">3623</span><br>--}}
{{--                          &raquo; Unique Chips: <span class="datetime">1015</span><br>--}}
{{--                          &raquo; Scans: <span class="datetime">11330</span><br>--}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
<div class="content">
    @include('_flash_message')
    @include('_errors')
    @yield('content')
</div>
<br>
<div class="footer">
    <table class="footer">
        <tr>
            <td width="100%">
                [<a href="#top">^ Top</a>]
                [<a href="{{ route('welcome') }}">Home</a>]
            </td>
            <td>
                <a href="net.html"><img src="{{ asset('images/spacer.gif') }}" width="1" height="1" border="0"></a>
            </td>
            <td nowrap>
                &copy; NES Cart Database 2005 - 2025
            </td>
        </tr>
    </table>
</div>
</body>

</html>
