@extends('layouts.master')

@section('title')
    Login
@endsection

@section('content')
    <main>

        <form method="POST" action="/login" id="form-login" class="form form-primary">
            {{ csrf_field() }}
            <h1 id="title-login" class="title-page">Login</h1>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password">
                <a class="link-sub" href="/">Forgot Password?</a>
                <span class="reg-error error"><?=$errors->first('password')?></span>
            </div>
            <button type="submit" class="btn btn-primary" id="btn-login">Login</button>
            <a class="link-sub" href="{{url('/register')}}">or Register Now</a>
        </form>
    </main>
@endsection
