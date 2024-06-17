<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authorize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function auth(Authorize $request){
        $user = User::where('email', $request->input('email'))->first();
        dd($user);
       Auth::attempt(['email'=> $request->input('email'), 'password'=> $request->input('password')]);
       dd(Auth::user());
    }
}
