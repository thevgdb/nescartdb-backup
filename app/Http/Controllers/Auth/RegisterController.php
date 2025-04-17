<?php

namespace App\Http\Controllers\Auth;

//use App\Http\Controllers\Controller as BaseController;
//use App\ValidationRules\PasswordValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models;
use Illuminate\Contracts\Auth\StatefulGuard;

class RegisterController extends BaseAuthController
{
    public function showRegisterPage(Request $request)
    {
        return view('auth.register')
            ->with('page_title', "NesCartDB - Register");
    }

    public function attemptRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => [
                'required',
                'unique:App\Models\User,name',
                'max:255',
                (new \App\Http\Controllers\Auth\ValidationRules\UsernameValidation()),
            ],
            'email' => [
                'nullable',
                'unique:App\Models\User,email',
                'max:255',
                (new \App\Http\Controllers\Auth\ValidationRules\EmailValidation()),
            ],
            'password' => [
                'required',
                'string',
                'min:1',
                'confirmed',
                (new \App\Http\Controllers\Auth\ValidationRules\PasswordValidation()),
            ],
        ]);

        if($validator->fails()) {
            return redirect()
                ->route('register')
                ->withErrors( $validator )
                ->withInput();
        }

//        // Retrieve the validated input...
//        $validated = $validator->validated();
//
//        // Retrieve a portion of the validated input...
//        $validated = $validator->safe()->only(['username', 'email', 'password']);
//        $validated = $validator->safe()->except(['name', 'email']);

        // Retrieve a portion of the validated input...
        $validated_input = $validator->safe()->only(['username', 'email', 'password']);

        // Store the new user...
        $newly_registered_user = new Models\User();
        $newly_registered_user->setAttribute( 'name', $validated_input['username'] );
        $newly_registered_user->setAttribute( 'email', $validated_input['email'] );
        $newly_registered_user->setAttribute( 'password', Hash::make($validated_input['password']) );
        $newly_registered_user->setAttribute( 'registered_at', now() );
        $newly_registered_user->setAttribute( 'last_ip', $request->ip() );
        $newly_registered_user->setAttribute( 'last_activity_at', now() );
        $newly_registered_user->save();

//        $this->guard()->login($newly_registered_user);

//        return $this->registered($request, $newly_registered_user)
//            ?: redirect($this->redirectPath());
        $this->after_successful_registration($request, $newly_registered_user);

//        return redirect('/posts');
        return redirect()
            ->route('login')
            ->with('flash_message', [
                'message' => 'You have been successfully registered! Now you may log in!',
                'type' => 'success',
            ]);
    }

    /**
     * Procedures that occur after a user has been successfully registered.
     *
     * @param Request $request
     * @param Models\User $newly_registered_user
     *
     * @return bool
     */
    protected function after_successful_registration(Request $request, Models\User $newly_registered_user): bool
    {
        return true;
    }
}
