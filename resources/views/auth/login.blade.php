@extends('_layout')

@section('content')
    <div class="headingmain">Login</div>

    <form action="{{ route('login.attempt') }}" method="POST">
        @csrf

        Username: <input name="username" type="text" value="{{ request()->old('username') }}"/><br/><br/>

        Password: <input name="password" type="password" value="{{ request()->old('password') }}"/><br/><br/>

        Remember Me: <input name="remember_me" type="checkbox"{{ request()->old('remember_me') ? ' checked' : '' }}/><br/><br/>

        <button type="submit">Log Me In!</button>
    </form>
@endsection
