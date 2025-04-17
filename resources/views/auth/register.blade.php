@extends('_layout')

@section('content')
    <div class="headingmain">Register</div>

    <form action="{{ route('register.attempt') }}" method="POST">
        @csrf

        Username: <input name="username" type="text" value="{{ request()->old('username') }}"/><br/><br/>

        E-Mail Address (optional): <input name="email" type="email" value="{{ request()->old('email') }}"/><br/><br/>

        Password: <input name="password" type="password" value="{{ request()->old('password') }}"/><br/><br/>
        Confirm Password: <input name="password_confirmation" type="password" value="{{ request()->old('password_confirmation') }}"/><br/><br/>

        <button type="submit">Register Account</button>
    </form>
@endsection
