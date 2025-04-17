@extends('_layout')

@section('content')
    @if( !$cart )
        <h3>Invalid profile specified!</h3>
    @else

        @if( config('nescartdb.show_backed_up_from_info_on_cart_profile_page', false) )
            <div style="padding: 5px; background-color: #1f1f2d; border: 1px solid #363460; color: #FFF; text-align: center; margin-bottom: 12px; font-size: 12px;">
                <img src="{{ asset('images/error.png') }}"/>
                <strong>Backed Up From:</strong>
                <a href="{{ $cart->originalUrl() }}">{{ $cart->originalUrl() }}</a>

                @if( !is_null($cart->getAttribute('backed_up_at')) )
                    | <strong>Backup Date:</strong> {{ $cart->getAttribute('backed_up_at')->format('Y-m-d h:i:s') }}
                @endif
            </div>
        @endif

        <table>
            <tbody>
            <tr>
                @if( $cart->hasImage('cart_top') )
                    <td rowspan="2">
                        @include('_display_image_position', ['cart' => $cart, 'position' => 'cart_top'])
                    </td>
                @endif

{{--                @if( $cart->hasImage('cart_top') )--}}
{{--                    <td rowspan="2">--}}
{{--                        <table align="left">--}}
{{--                            <tr>--}}
{{--                                <td>--}}
{{--                                    <a class="myimg" href="{{ route('image', ['cart_id' => $cart->getAttribute('cart_id'), 'position' => 'cart_top']) }}" onmouseover="ddrivetip('{{ (string) isset($cart->getAttribute('images')['cart_top']) ? $cart->getAttribute('images')['cart_top']['ddrivetip'] : "" }}')" onMouseout="hideddrivetip()">--}}
{{--                                        <img align="middle" border="0" alt="" src="{{ $cart->thumbnailUrl('cart_top') }}">--}}
{{--                                    </a>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        </table>--}}
{{--                    </td>--}}
{{--                @endif--}}

                <td nowrap="" class="headingmain" valign="bottom" width="100%">
                    {{ $cart->getAttribute('game_title') }}
                </td>
                <td rowspan="2" align="right">

{{--                    <table class="simbox">--}}
{{--                      <tr class="header">--}}
{{--                        <td nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Operations&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>--}}
{{--                      </tr>--}}
{{--                      <tr>--}}
{{--                        <td>--}}
{{--                          <table class="simboxcontent">--}}
{{--                            <tr class="textsmall">--}}
{{--                              <td>--}}
{{--                                <a href="?cartid=2570" onclick="return popup(this, 'AddImage')">--}}
{{--                                    <img src="{{ asset('images/image_add.png') }}" title="Add an image to profile" alt="add image" border="0">--}}
{{--                                    Add Image--}}
{{--                                </a>--}}
{{--                                  <br>--}}
{{--                                  <a href="?cartid=2570" onclick="return popup(this, 'RemoveImage')">--}}
{{--                                      <img src="{{ asset('images/image_delete.png') }}" title="Remove an image from profile" alt="remove image" border="0">--}}
{{--                                      Remove Image--}}
{{--                                  </a>--}}
{{--                                  <br>--}}
{{--                                  <a href="?cartid=2570" onclick="return popup(this, 'ReportError')">--}}
{{--                                      <img src="{{ asset('images/error.png') }}" title="Report an error with this profile" alt="report error" border="0">--}}
{{--                                      Report Error--}}
{{--                                  </a>--}}
{{--                                  <br>--}}
{{--                                  <a href="?cartid=2570" onclick="return popup(this, 'DisableProfile')">--}}
{{--                                      <img src="{{ asset('images/delete.png') }}" title="Disable this profile" alt="disable" border="0">--}}
{{--                                      Disable Profile--}}
{{--                                  </a>--}}
{{--                                  <br>--}}
{{--                                  <a href="?cartid=2570" onclick="return popup(this, 'GroupProfile')">--}}
{{--                                      <img src="{{ asset('images/unlink.png') }}" title="Remove relationship to other profiles" alt="group" border="0">--}}
{{--                                      Remove Relationship--}}
{{--                                  </a>--}}
{{--                                  <br>--}}
{{--                                  <a href="?cartid=2570" onclick="return popup(this, 'DuplicateProfile')">--}}
{{--                                      <img src="{{ asset('images/page_copy.png') }}" alt="duplicate" title="Create a duplicate of this profile" border="0">--}}
{{--                                      Create Duplicate--}}
{{--                                  </a>--}}
{{--                                  <br>--}}
{{--                              </td>--}}
{{--                            </tr>--}}
{{--                          </table>--}}
{{--                        </td>--}}
{{--                      </tr>--}}
{{--                    </table>--}}

                </td>
                <td rowspan="2" align="right">

                    @if( count($more_profiles) > 1 )
                        <table class="simbox">
                            <tr class="header">
                                <td nowrap>More Profiles</td>
                            </tr>
                            <tr>
                                <td>
                                    <table class="simboxcontent">
                                        <tr class="textsmall">
                                            <td>
                                                {!! render_flag_html( $cart->getAttribute('cart_details')['Region'], [
    'title' => $cart->getAttribute('cart_details')['Region'] . " (" . $cart->getAttribute('cart_details')['Region'] . "): " . $cart->getAttribute('game_title'),
    'alt' => $cart->getAttribute('cart_details')['Region'] . " (" . $cart->getAttribute('cart_details')['Region'] . "): " . $cart->getAttribute('game_title'),
    ] ) !!}
                                            </td>
                                            <td align="right" width="100%">
                                                @foreach( $more_profiles as $key => $current_more_profile ){{--
                                                    --}}<a href="{{ $current_more_profile->publicUrl() }}">{!! ($cart == $current_more_profile ? '<u>' : '') !!}{{ (string)($key + 1) }}{!! ($cart == $current_more_profile ? '</u>' : '') !!}</a>{{ !$loop->last ? '|' : '' }}{{--
                                                    --}}@endforeach
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    @endif

                </td>
                <td rowspan="2" align="right">
                    @if( count($related_profiles) > 0 )
                        <table class="simbox">
                            <tr class="header">
                                <td nowrap>Related Profiles</td>
                            </tr>
                            <tr>
                                <td>
                                    <table class="simboxcontent">
                                        <tr class="textsmall">
                                            <td>
                                                @foreach( $related_profiles as $key => $current_related_profile )
                                                    <a href="{{ $current_related_profile->publicUrl() }}">
                                                        {!! render_flag_html( $current_related_profile->getAttribute('cart_details')['Region'], [
    'title' => $cart->getAttribute('cart_details')['Region'] . ": " . $current_related_profile->getAttribute('game_title'),
    ] ) !!}
                                                    </a>
                                                @endforeach
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    @endif
                </td>
            </tr>
            @if( strlen($cart->getAttribute('game_subtitle')) > 0 )
                <tr valign="top">
                    <td nowrap="" class="headingsubtitle">
                        {{ $cart->getAttribute('game_subtitle') }}
                    </td>
                </tr>
            @endif
            <tr valign="top">
                <td nowrap="" class="textsmall">
                    » Submitted by: <a href="{{ route('search.advanced', ['sub' => $cart->submitterUser->getAttribute('name'), 'group' => 'cartid']) }}">{{ $cart->submitterUser->getAttribute('name') }}</a>
                    Time: <span class="datetime">{{ $cart->getAttribute('submitted')->format('Y-m-d H:i:s') }}</span>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <img src="{{ asset('images/head_line.gif') }}" alt="" class="line">
                </td>
            </tr>
            </tbody>
        </table>

        <table>
            <tbody><tr valign="top">
                <td>
                    <table><tbody><tr><td height="230"></td></tr></tbody></table>
                </td>
                <td>
                    <table>
                        <tbody><tr valign="top">
                            <td id="cartfront" width="200">
                                @include('_display_image_position', ['cart' => $cart, 'position' => 'cart_front'])

{{--                                @if( $cart->hasImage('cart_front') )--}}
{{--                                    <table align="left">--}}
{{--                                        <tbody><tr>--}}
{{--                                            <td>--}}
{{--                                                <a href="{{ route('image', ['cart_id' => $cart->getAttribute('cart_id'), 'position' => 'cart_front']) }}" class="myimg" onmouseover="ddrivetip('{{ (string) isset($cart->getAttribute('images')['cart_front']) ? $cart->getAttribute('images')['cart_front']['ddrivetip'] : "" }}')" onmouseout="hideddrivetip()">--}}
{{--                                                    <img align="middle" border="0" alt="" src="{{ $cart->thumbnailUrl('cart_front') }}">--}}
{{--                                                </a>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                @endif--}}
                            </td>
                            <td id="cartback" style="display:none;" width="200">
                                @include('_display_image_position', ['cart' => $cart, 'position' => 'cart_back'])

{{--                                @if( $cart->hasImage('cart_back') )--}}
{{--                                    <table align="left">--}}
{{--                                        <tbody><tr>--}}
{{--                                            <td>--}}
{{--                                                <a href="{{ route('image', ['cart_id' => $cart->getAttribute('cart_id'), 'position' => 'cart_back']) }}" class="myimg" onmouseover="ddrivetip('{{ (string) isset($cart->getAttribute('images')['cart_back']) ? $cart->getAttribute('images')['cart_back']['ddrivetip'] : "" }}')" onmouseout="hideddrivetip()">--}}
{{--                                                    <img align="middle" border="0" alt="" src="{{ $cart->thumbnailUrl('cart_back') }}">--}}
{{--                                                </a>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                @endif--}}
                            </td>
                        </tr>
                        @if( $cart->hasImage('cart_back') )
                            <tr>
                                <td align="center">
                                    <button id="cartpicbutton" name="cartback" type="button" onclick="swap_cart_pic()">View Other Side</button>
                                </td>
                            </tr>
                        @endif
                        </tbody></table>
                </td>
                <td>
                    <table>
                        <tbody>
                            @if( isset($cart->getAttribute('cart_details')['Catalog ID']) && strlen($cart->getAttribute('cart_details')['Catalog ID']) > 0 )
                                <tr class="textmain" align="left">
                                    <th>Catalog ID</th>
                                    <td class="textmain" width="100%">
                                        {{ $cart->getAttribute('cart_details')['Catalog ID'] }}
                                    </td>
                                </tr>
                            @endif
                            <tr class="textmain" align="left">
                                <th>Region</th>
                                <td class="textmain" width="100%">
                                    {!! render_flag_html( $cart->getAttribute('cart_details')['Region'] ) !!}
                                    {{ $cart->getAttribute('cart_details')['Region'] }} ({{ $cart->getAttribute('cart_details')['Video System'] }})
                                </td>
                            </tr>
                            <tr class="textmain" align="left">
                                <th>Class</th>
                                <td class="textmain" width="100%">
                                    {{ $cart->getAttribute('cart_details')['Class'] }}
                                </td>
                            </tr>
                            <tr class="textmain" align="left">
                                <th>Release Date</th>
                                <td class="textmain" width="100%">
                                    {{ $cart->getAttribute('cart_details')['Release Date'] }}
                                </td>
                            </tr>
                            <tr class="textmain" align="left">
                                <th>Publisher</th>
                                <td class="textmain" width="100%">
                                    <a href="{{ route('search.advanced', [ 'publisher' => $cart->getAttribute('cart_details')['Publisher'] ]) }}">{{ $cart->getAttribute('cart_details')['Publisher'] }}</a>
                                </td>
                            </tr>
                            <tr class="textmain" align="left">
                                <th>Developer</th>
                                <td class="textmain" width="100%">
                                    <a href="{{ route('search.advanced', [ 'developer' => $cart->getAttribute('cart_details')['Developer'] ]) }}">{{ $cart->getAttribute('cart_details')['Developer'] }}</a>
                                </td>
                            </tr>
                            <tr class="textmain" align="left">
                                <th>Players</th>
                                <td class="textmain" width="100%">
                                    {{ $cart->getAttribute('cart_details')['Players'] }}
                                </td>
                            </tr>
                            <tr class="textmain" align="left">
                                <th>Peripherals</th>
                                <td class="textmain" width="100%">
                                    <!-- <img src="ctrl_pad.png" alt="NES Controller" title="NES Controller"  border="0">&nbsp; -->
                                    {{ $cart->getAttribute('cart_details')['Peripherals'] }}
                                </td>
                            </tr>
                            @if( isset($cart->getAttribute('cart_details')['Ported by']) && strlen($cart->getAttribute('cart_details')['Ported by']) > 0 )
                                <tr class="textmain" align="left">
                                    <th>Ported By</th>
                                    <td class="textmain" width="100%">
                                        {{ $cart->getAttribute('cart_details')['Ported by'] }}
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td><img src="{{ asset('images/spacer.gif') }}" alt="" width="120" height="1" border="0"></td>
                                <td><img src="{{ asset('images/spacer.gif') }}" alt="" width="180" height="1" border="0"></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td>
                    <table>
                        <tbody>
                            <tr align="left">
                                <td colspan="2" class="headingmain">Cart Properties</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <img src="{{ asset('images/head_line.gif') }}" alt="" width="100%" height="1" vspace="2"/>
                                </td>
                            </tr>
                            <tr class="textmain" align="left">
                                <th>Cart Producer</th>
                                <td class="textmain" width="100%">
                                    {!! render_producer_image_html( $cart->getAttribute('cart_properties')['Cart Producer'] ) !!}
    {{--                                <img src="/img/prod_famicom.png" border="0" vspace="0" alt="" title="Nintendo (Famicom)">--}}
    {{--                                {{ $cart->getAttribute('cart_properties')['Cart Producer'] }}--}}
                                </td>
                            </tr>
                            @foreach( ['Color', 'Form Factor', 'Front Label ID', 'Embossed Text', 'Seal of Quality', 'MfgString Present', 'Revision', 'Secondary ID', 'Front Label Desc', 'Back Label Desc', 'Sequence #', 'Back Label ID', 'Back Label ID / Desc', '2-digit Code', '4-digit Code'] as $column_key )
                                @if( isset($cart->getAttribute('cart_properties')[ $column_key ]) && strlen($cart->getAttribute('cart_properties')[ $column_key ]) > 0 )
                                    <tr class="textmain" align="left">
                                        <th>{{ $column_key }}</th>
                                        <td class="textmain" width="100%">
                                            {{ $cart->getAttribute('cart_properties')[$column_key] }}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            <tr>
                                <td><img src="{{ asset('images/spacer.gif') }}" alt="" width="150" height="1" border="0"></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>

        <table>
            <tbody><tr valign="top">
                <td width="450">
                    <table>
                        <tbody><tr align="left">
                            <td colspan="4" class="headingmain">ROM Details</td>
                        </tr>
                        <tr class="textmain" align="left">
                            <th width="40">Type</th>
                            <th width="200">Label</th>
                            <th width="50" align="center">Size</th>
                            <th width="80" align="center">CRC32</th>
                            <th width="20" title="Times verified">x !</th>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <img src="{{ asset('images/head_line.gif') }}" alt="" width="100%" height="1" vspace="1" border="0"/>
                            </td>
                        </tr>

                        @foreach( $cart->getAttribute('rom_details') as $current_rom_detail )
                            <tr class="textmain">
                                @if( $current_rom_detail['type'] == "ROMs Combined:" )
                                    <td colspan="2">{{ $current_rom_detail['type'] }}</td>
                                @else
                                    <td>{{ $current_rom_detail['type'] }}</td>
                                    <td>{{ $current_rom_detail['label'] }}</td>
                                @endif
                                <td align="center">{{ $current_rom_detail['size'] }}</td>
                                <td align="center" title="SHA-1:{{ $current_rom_detail['sha1'] }}">{{ $current_rom_detail['crc32'] }}</td>
                                <td align="center">{{ $current_rom_detail['number_of_verifications'] }}</td>
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="5">
                                <table>
                                    <tbody><tr>
                                        <td>
                                            @include('_display_image_position', ['cart' => $cart, 'position' => 'pcb_front'])

{{--                                            @if( $cart->hasImage('pcb_front') )--}}
{{--                                                <table align="left">--}}
{{--                                                    <tbody><tr>--}}
{{--                                                        <td>--}}
{{--                                                            <a href="{{ route('image', ['cart_id' => $cart->getAttribute('cart_id'), 'position' => 'pcb_front']) }}" class="myimg" onmouseover="ddrivetip('{{ (string) isset($cart->getAttribute('images')['pcb_front']) ? $cart->getAttribute('images')['pcb_front']['ddrivetip'] : "" }}')" onmouseout="hideddrivetip()">--}}
{{--                                                                <img align="middle" border="0" alt="" src="{{ $cart->thumbnailUrl('pcb_front') }}">--}}
{{--                                                            </a>--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
{{--                                                    </tbody>--}}
{{--                                                </table>--}}
{{--                                            @endif--}}

{{--                                            <table align="left">--}}
{{--                                                <tbody><tr>--}}
{{--                                                    <td>--}}
{{--                                                        <a href="{{ route('image', ['cart_id' => $cart->getAttribute('cart_id'), 'position' => 'pcb_front']) }}" class="myimg" onmouseover="ddrivetip('PCB Front<br>{{ $cart->getAttribute('pcb_name') }}<br>Submitted by: bootgod<br>Linked from profile 0')" onmouseout="hideddrivetip()">--}}
{{--                                                            <img align="middle" border="0" alt="" src="{{ asset('storage/images/175/e2305d2d778e52fd18fab551ba5b90cb.jpg') }}">--}}
{{--                                                        </a>--}}
{{--                                                    </td>--}}
{{--                                                </tr>--}}
{{--                                                </tbody>--}}
{{--                                            </table>--}}

                                        </td>
                                        @if( $cart->hasImage('pcb_back') )
                                            <td>
                                                @include('_display_image_position', ['cart' => $cart, 'position' => 'pcb_back'])
                                            </td>
                                        @endif
                                    </tr>
                                    </tbody>
                                </table>


                            </td>
                        </tr>
                        </tbody></table>
                </td>
                <td width="77"></td>
                <td>
                    <table>
                        <tbody><tr align="left">
                            <td colspan="2" class="headingmain"><a href="{{ route('search.advanced', ['pcb' => $cart->getAttribute('pcb_name')]) }}">{{ $cart->getAttribute('pcb_name') }}</a></td>
                        </tr>
                        <tr>
                            <td colspan="2"><img src="{{ asset('images/head_line.gif') }}" width="100%" alt="" height="1" vspace="5" border="0"></td>
                        </tr>
                        <tr class="textmain" align="left">
                            <th>PCB Producer</th>
                            <td class="textmain" width="100%">
                                {!! render_producer_image_html( $cart->getAttribute('pcb_details')['PCB Producer'] ) !!}
                            </td>
                        </tr>
                        <tr class="textmain" align="left">
                            <th>Manufacturer</th>
                            <td class="textna" width="100%">
                                {{ $cart->getAttribute('pcb_details')['Manufacturer'] }}
                            </td>
                        </tr>
                        <tr class="textmain" align="left">
                            <th>Mfg Range</th>
                            <td class="textmain" width="100%">
                                {{ $cart->getAttribute('pcb_details')['Mfg Range'] }}
                            </td>
                        </tr>
                        <tr class="textmain" align="left">
                            <th>Est First Run</th>
                            <td class="textmain" width="100%">
                                {{ $cart->getAttribute('pcb_details')['Est First Run'] }}
                            </td>
                        </tr>
                        <tr class="textmain" align="left">
                            <th>PCB Class</th>
                            <td class="textmain" width="100%">
                                <a href="{{ route('search.advanced', [ 'unif' => $cart->getAttribute('pcb_details')['PCB Class'] ]) }}">{{ $cart->getAttribute('pcb_details')['PCB Class'] }}</a>
                            </td>
                        </tr>
                        <tr class="textmain" align="left">
                            <th>iNES Mapper</th>
                            <td class="textmain" width="100%">
                                <a href="{{ route('search.advanced', [ 'ines' => $cart->getAttribute('pcb_details')['iNES Mapper'] ]) }}">{{ $cart->getAttribute('pcb_details')['iNES Mapper'] }}</a>
                            </td>
                        </tr>
                        @foreach( ['Mirroring', 'Battery present', 'WRAM', 'VRAM', 'CIC Type', 'Hardware'] as $column_key )
                            @if( isset($cart->getAttribute('pcb_details')[ $column_key ]) && strlen($cart->getAttribute('pcb_details')[ $column_key ]) > 0 )
                                <tr class="textmain" align="left">
                                    <th>{{ $column_key }}</th>
                                    <td class="textmain" width="100%">
                                        {{ $cart->getAttribute('pcb_details')[ $column_key ] }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        <tr>
                            <td>
                                <img src="{{ asset('images/spacer.gif') }}" alt="" width="150" height="1" border="0"/>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </td>
            </tr>
            </tbody>
        </table>

        <table>
            <tbody><tr>
                <td colspan="4">
                    <table cellpadding="0">
                        <tbody><tr align="left">
                            <td colspan="2" class="headingmain">Detailed Chip Info</td>
                        </tr>
                        <tr class="textmain" align="left">
                            <th>Designation</th>
                            <th align="center">Maker</th>
                            <th>Part #</th>
                            <th>Type</th>
                            <th align="center">Package</th>
                            <th>DateCode</th>
                            <th>&nbsp;</th>
                            <th align="right" title="Normalized DateCode">Std</th>
                            <th align="center">Misc</th>
                        </tr>
                        <tr>
                            <td colspan="8">
                                <img src="{{ asset('images/head_line.gif') }}" width="100%" alt="" height="1" vspace="2"/>
                            </td>
                        </tr>
                        @foreach( $cart->getAttribute('detailed_chip_info') as $current_detailed_chip_info )
                            <tr class="textmain">
                                <td>
                                    {{ $current_detailed_chip_info['designation'] }}
                                </td>
                                <td height="20" align="center">
                                    {{ $current_detailed_chip_info['maker'] }}
                                </td>
                                <td>
{{--                                    <span class="implied">UPD23C2013</span>--}}
                                    {{ $current_detailed_chip_info['part_number'] }}
                                    <span class="subdetail">{{ $current_detailed_chip_info['part_number_subdetail'] }}</span>
                                </td>
                                <td>
                                    {{ $current_detailed_chip_info['type'] }}
                                    <span class="subdetail">{{ $current_detailed_chip_info['type_subdetail'] }}</span>
                                </td>
                                <td align="center">
                                    {{ $current_detailed_chip_info['package'] }}
                                </td>
                                <td class="textna">
                                    <span style="COLOR: white">{{ $current_detailed_chip_info['datecode'] }}</span>
                                    {{ $current_detailed_chip_info['datecode_subdetail'] }}
                                </td>
                                <td> » </td>
                                <td class="subdetail" align="center">
                                    {{ $current_detailed_chip_info['datecode_standardized'] }}
                                </td>
                                <td align="center">
                                    {{ $current_detailed_chip_info['misc'] }}
                                </td>
                            </tr>




{{--                            <tr class="textmain">--}}
{{--                                @if( $current_rom_detail['type'] == "ROMs Combined:" )--}}
{{--                                    <td colspan="2">{{ $current_rom_detail['type'] }}</td>--}}
{{--                                @else--}}
{{--                                    <td>{{ $current_rom_detail['type'] }}</td>--}}
{{--                                    <td>{{ $current_rom_detail['label'] }}</td>--}}
{{--                                @endif--}}
{{--                                <td align="center">{{ $current_rom_detail['size'] }}</td>--}}
{{--                                <td align="center" title="SHA-1:{{ $current_rom_detail['sha1'] }}">{{ $current_rom_detail['crc32'] }}</td>--}}
{{--                                <td align="center">{{ $current_rom_detail['number_of_verifications'] }}</td>--}}
{{--                            </tr>--}}
                        @endforeach
                        <tr>
                            <td><img src="{{ asset('images/spacer.gif') }}" alt="" width="90" height="1" border="0"></td>
                            <td><img src="{{ asset('images/spacer.gif') }}" alt="" width="90" height="1" border="0"></td>
                            <td><img src="{{ asset('images/spacer.gif') }}" alt="" width="150" height="1" border="0"></td>
                            <td><img src="{{ asset('images/spacer.gif') }}" alt="" width="130" height="1" border="0"></td>
                            <td><img src="{{ asset('images/spacer.gif') }}" alt="" width="80" height="1" border="0"></td>
                            <td><img src="{{ asset('images/spacer.gif') }}" alt="" width="50" height="1" border="0"></td>
                            <td><img src="{{ asset('images/spacer.gif') }}" alt="" width="10" height="1" border="0"></td>
                            <td><img src="{{ asset('images/spacer.gif') }}" alt="" width="10" height="1" border="0"></td>
                            <td><img src="{{ asset('images/spacer.gif') }}" alt="" width="70" height="1" border="0"></td>
                        </tr>

{{--                        --}}
{{--                        <tr class="textmain">--}}
{{--                            <td>U1 PRG</td>--}}
{{--                            <td height="20" align="center">NEC</td>--}}
{{--                            <td><span class="implied">UPD23C2013</span>&nbsp;<span class="subdetail">T05</span></td>--}}
{{--                            <td>Mask ROM&nbsp;<span class="subdetail">256 KB</span></td>--}}
{{--                            <td align="center">DIP-32</td>--}}
{{--                            <td class="textna"><span style="COLOR: white">8846</span>EY</td>--}}
{{--                            <td>&nbsp;»&nbsp;</td>--}}
{{--                            <td class="subdetail" align="center">8846</td>--}}
{{--                            <td align="center"></td>--}}
{{--                        </tr>--}}
{{--                        <tr class="textmain">--}}
{{--                            <td>U2 CHR</td>--}}
{{--                            <td height="20" align="center">NEC</td>--}}
{{--                            <td>D4364C-15L</td>--}}
{{--                            <td>SRAM&nbsp;<span class="subdetail">8 KB</span>&nbsp;<span class="subdetail">(150 ns)</span></td>--}}
{{--                            <td align="center">DIP-28</td>--}}
{{--                            <td class="textna"><span style="COLOR: white">8842</span>MU612</td>--}}
{{--                            <td>&nbsp;»&nbsp;</td>--}}
{{--                            <td class="subdetail" align="center">8842</td>--}}
{{--                            <td align="center"></td>--}}
{{--                        </tr>--}}
{{--                        <tr class="textmain">--}}
{{--                            <td>U3 MMC1</td>--}}
{{--                            <td height="20" align="center">Sharp</td>--}}
{{--                            <td>MMC1A</td>--}}
{{--                            <td>Nintendo MMC1</td>--}}
{{--                            <td align="center">DIP-24</td>--}}
{{--                            <td class="textna"><span style="COLOR: white">8846</span> 3 A</td>--}}
{{--                            <td>&nbsp;»&nbsp;</td>--}}
{{--                            <td class="subdetail" align="center">8846</td>--}}
{{--                            <td align="center"></td>--}}
{{--                        </tr>--}}
                        <!--
                                      <tr class="textmain">
                                        <td ><i>U1</i> PRG</td>
                                        <td height="20" align="center"><img src="ami.gif" border="0" vspace="0" alt="" title="AMI"></td>
                                        <td ><span class="implied">AM231002</span></td>
                                        <td >Mask ROM&nbsp;<span class="subdetail">128 KB</span></td>
                                        <td align="center">DIP-28</td>
                                        <td class="textna"><span style="color: white">8943</span> </td>
                                        <td >&nbsp;&raquo;&nbsp;</td>
                                        <td class="subdetail" align="center">8943</td>
                                        <td align="center"></td>
                                      </tr> -->
                        </tbody>
                    </table>

                </td>
            </tr>
            </tbody>
        </table>

        @if( $cart->hasImage('box_front') || $cart->hasImage('box_back') || $cart->hasImage('manual') || $cart->hasImage('insert') )
            <br>
            <div class="headingmain">Additional Images</div>
            <table cellpadding="3">
                <tr valign="top">
                    <td>
                        @include('_display_image_position', ['cart' => $cart, 'position' => 'box_front'])
                    </td>
                    <td>
                        @include('_display_image_position', ['cart' => $cart, 'position' => 'box_back'])
                    </td>
                    <td>
                        @include('_display_image_position', ['cart' => $cart, 'position' => 'manual'])
                    </td>
                    <td>
                        @include('_display_image_position', ['cart' => $cart, 'position' => 'insert'])
                    </td>
                </tr>
            </table>
        @endif

    @endif
@endsection
