<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('registration.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
           'first_name'=>'required',
           'last_name'=>'required',
           'email'=>'required|email|unique:users',
           'password'=>'required'
        ]);

        $user = User::create(request(['first_name','last_name','email','password']));

        auth()->login($user);

        return redirect()->to('/');
    }
}
