<?php

namespace App\Controllers;

class AuthController extends BaseController
{
    public function signIn(): string
    {
        return view('pages/dashboard');
    }
    
    public function signUp(): string
    {
        return view('pages/signup');
    }
}
