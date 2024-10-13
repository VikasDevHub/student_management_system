<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request){

        if($request->isMethod('post')){

            $validator = Validator::make($request->all(),[
               'email' => 'required|email',
                'password' => 'required|min:8',
            ]);

            if($validator->fails()){
                return redirect()->route('login')->withInput()->withErrors($validator);
            }

            $credential = $validator->validated();

            if(!Auth::attempt($credential)){
                return redirect()->route('login')->withInput($request->only('email'))->withErrors(['email' => 'The provided credentials do not match our records.',]);
            }

            $request->session()->regenerate();

            return redirect()->intended('admin/dashboard')->with('success','Login Successful');

        }
        return view('backend.auth.login');
    }

    public function logout(Request $request){

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
