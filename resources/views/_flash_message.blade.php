@if( Session::has('flash_message') )
    <div class="flash_message flash_message--{{ isset(Session::get('flash_message')['type']) ? Session::get('flash_message')['type'] : 'success' }}">
        <div class="alert">
{{--            @if( !(isset(Session::get('flash_message')['dismissable']) && Session::get('flash_message')['dismissable'] === false) )--}}
{{--                <button type="button" class="close" data-dismiss="alert">×</button>--}}
{{--            @endif--}}
            <div>
                {!! isset(Session::get('flash_message')['message']) ? Session::get('flash_message')['message'] : '' !!}
            </div>
        </div>
    </div>
@endif
