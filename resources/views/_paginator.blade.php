Showing results: {{ $paginator->firstItem() }} thru {{ $paginator->lastItem() }} of {{ $paginator->total() }}
@if($paginator->hasPages())
    &nbsp;&nbsp;<span style="color: #808080">&lt;&lt;</span>&nbsp;
    @foreach($elements as $element)
{{--        --}}{{-- "Three Dots" Separator --}}
{{--        @if (is_string($element))--}}
{{--            <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>--}}
{{--        @endif--}}

        {{-- Array Of Links --}}
        @if(is_array($element))
            @foreach($element as $page => $url)
                @if($page == $paginator->currentPage())
{{--                    <li class="active" aria-current="page"><span>{{ $page }}</span></li>--}}
                    {{ $page }}&nbsp;
                @else
{{--                    <li><a href="{{ $url }}">{{ $page }}</a></li>--}}
                    <a href="{{ $url }}">{{ $page }}</a>&nbsp;
                @endif
            @endforeach
        @endif
    @endforeach
    <span style="color: #808080">&gt;&gt;</span>&nbsp;



{{--    1&nbsp;--}}
{{--    <a href="{{ route('search.advanced', ['page' => 2]) }}">2</a>&nbsp;--}}
{{--    <a href="{{ route('search.advanced', ['page' => 11]) }}">11</a>&nbsp;--}}
{{--    <span style="color: #808080">&gt;&gt;</span>&nbsp;--}}
@endif







{{--        Showing results: 1 thru 50 of {{ $carts->total() }}--}}
{{--        &nbsp;&nbsp;<span style="color: #808080">&lt;&lt;</span>&nbsp;--}}
{{--        1&nbsp;--}}
{{--        <a href="https://nescartdb.com/search/advanced?page=2">2</a>&nbsp;--}}
{{--        <a href="{{ route('search.advanced', ['page' => 2]) }}">2</a>&nbsp;--}}
{{--        <a href="https://nescartdb.com/search/advanced?page=3">3</a>&nbsp;--}}
{{--        <a href="https://nescartdb.com/search/advanced?page=4">4</a>&nbsp;--}}
{{--        <a href="https://nescartdb.com/search/advanced?page=5">5</a>&nbsp;--}}
{{--        <a href="https://nescartdb.com/search/advanced?page=6">6</a>&nbsp;--}}
{{--        <a href="https://nescartdb.com/search/advanced?page=7">7</a>&nbsp;--}}
{{--        <a href="https://nescartdb.com/search/advanced?page=8">8</a>&nbsp;--}}
{{--        <a href="https://nescartdb.com/search/advanced?page=9">9</a>&nbsp;--}}
{{--        <a href="https://nescartdb.com/search/advanced?page=10">10</a>&nbsp;--}}
{{--        <a href="https://nescartdb.com/search/advanced?page=11">11</a>&nbsp;--}}
{{--        <span style="color: #808080">&gt;&gt;</span>&nbsp;--}}
