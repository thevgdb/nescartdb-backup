<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;

if( !function_exists('current_user') ) {
    function current_user(): Authenticatable
    {
        return auth()->user();
//        return Auth::user();
    }
}
