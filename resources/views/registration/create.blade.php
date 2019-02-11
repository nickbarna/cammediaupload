@extends('layouts.master')

@section('title')
    Register
@endsection

@section('content')


    <form method="POST" action="/register" id="form-register" class="form form-primary">
        {{ csrf_field() }}
        <div class="titles-page">
            <h1 id="title-register" class="title-page">Register</h1>
            <h4>(must have a valid coastalanglermagazine.com email)</h4>
        </div>
        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" class="form-control" id="first_name" name="first_name">
        </div>

        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" class="form-control" id="last_name" name="last_name">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email">
            <span class="reg-error error"><?=$errors->first('email')?></span>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>


    </form>

@endsection
