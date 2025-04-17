<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use App\Models;
use Illuminate\Support\Facades\Auth;

class BaseAuthController extends BaseController
{
    /**
     * Get the guard to be used during registration.
     *
     * @return StatefulGuard
     */
    protected function guard(): StatefulGuard
    {
        return Auth::guard();
    }

    protected function abortIfAuthenticationIsDisabled(Request $request)
    {
        if( !config('nescartdb.user_authentication_enabled') ) {
            abort( 404 );
        }
    }
}
