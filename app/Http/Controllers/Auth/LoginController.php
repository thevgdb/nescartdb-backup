<?php

namespace App\Http\Controllers\Auth;

//use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends BaseAuthController
{
    public function showLoginPage(Request $request)
    {
        return view('auth.login')
            ->with('page_title', "NesCartDB - Login");
    }

    public function attemptLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => [
                'required',
            ],
            'password' => [
                'required',
            ],
            'remember_me' => [

            ],
        ]);

//        dd( $validator->errors()->toArray() );

        if($validator->fails()) {
            return redirect()
                ->route('login')
//                ->withErrors( $validator )
                ->with('errors', $validator->errors()->toArray())
                ->withInput();
        }

        $validated_input = $validator->safe()->only(['username', 'password', 'remember_me']);
//        dd( $validated_input );

//        $user_with_this_username = Models\User::query()->where('name', $validated_input['username'])->first();
//        if( !$user_with_this_username ) {
//
//        }

//        $user_with_this_username = Models\User::query()->where('name', $validated_input['username'])->first();
//        if( $user_with_this_username && $user_with_this_username->getAttribute('password') == Hash::make($validated_input['password']) )
//        {
//            // TODO
//        }
        $remember_this_login = isset($validated_input['remember_me']) && filter_var($validated_input['remember_me'], FILTER_VALIDATE_BOOL);
        if( $this->checkLoginCredentials($validated_input['username'],
            $validated_input['password'],
            $remember_this_login
        )) {
//            $remember_this_login = isset($validated_input['remember_me']) && filter_var($validated_input['remember_me'], FILTER_VALIDATE_BOOL);
//            Auth::login( $successfully_logged_in_user , $remember_this_login );

//            $this->after_successfully_logged_in($request, $successfully_logged_in_user);
            $authed_user = Auth::user();
            $this->after_successfully_logged_in($request, $authed_user);

            return redirect()
                ->route('welcome')
                ->with('flash_message', [
                    'message' => 'You have been successfully logged in! Welcome back!',
                    'type' => 'success',
                ]);



        }

        return redirect()
            ->route('login')
            ->with("errors", [
                "username" => [
                    "The login credentials are invalid.",
                ]
            ])
            ->withInput();

//        $this->guard()->login($newly_registered_user);
    }

    /**
     * @param string $username
     * @param string $password
     * @param bool $remember_me
     *
     * @return bool
     */
    private function checkLoginCredentials(string $username, string $password, bool $remember_me = false): bool
    {
        return $this->guard()->attempt([
            'name' => $username,
            'password' => $password,
        ], $remember_me);

//        if( $this->guard()->attempt([
//            'name' => $username,
//            'password' => $password,
//        ], $remember_me)) {
//            // ...
//        }

////        dd($password);
//        $user_with_this_username = Models\User::query()->where('name', $username)->first();
//        if( $user_with_this_username && $user_with_this_username->getAttribute('password') == Hash::make($password) )
//        {
//            return $user_with_this_username;
//        }
//        return false;
    }

    private function after_successfully_logged_in(Request $request, Models\User &$successfully_logged_in_user)
    {
        $successfully_logged_in_user->setAttribute( 'last_login_at', now() );

//        $successfully_logged_in_user->increment('login_count');
        $previous_login_count = (int)$successfully_logged_in_user->getAttribute('login_count');
        $successfully_logged_in_user->setAttribute( 'login_count', ++$previous_login_count );

        $successfully_logged_in_user->setAttribute( 'last_ip', $request->ip() );
        $successfully_logged_in_user->setAttribute( 'last_activity_at', now() );

        $successfully_logged_in_user->save();

    }



    public function processLogout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('welcome')
            ->with('flash_message', [
                'message' => 'You have been successfully logged out! Come again soon!',
                'type' => 'success',
            ]);
    }
}
