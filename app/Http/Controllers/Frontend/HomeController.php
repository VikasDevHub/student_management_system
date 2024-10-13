<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index() {

        return view('frontend.home');

    }

    public function studentLogin(Request $request) {

        if($request->isMethod('post')) {
            $validator = Validator::make($request->all(),[
                'email' => 'required|email',
                'password' => 'required|min:8'
            ]);

            if($validator->fails()) {
                return redirect()->route('student.login')->withInput()->withErrors($validator);
            }

            $credentials = $validator->validated();

            if(!Auth::guard('student')->attempt($credentials)){
                return redirect()->route('student.login')->withInput($request->only('email'))->withErrors(['email' => 'The provided credentials do not match our records.',]);
            }

            $request->session()->regenerate();

            return redirect()->intended('student/dashboard')->with('success','Login Successful');
        }

        return view('backend.auth.student-login');
    }

    public function studentLogout(Request $request){

        Auth::guard('student')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('student.login');
    }

    public function teacherLogin(Request $request) {

        if($request->isMethod('post')) {

            $validator = Validator::make($request->all(),[
                'email' => 'required|email',
                'password' => 'required|min:8'
            ]);

            if($validator->fails()) {
                return redirect()->route('teacher.login')->withInput()->withErrors($validator);
            }
            $credentials = $validator->validated();

            if(!Auth::guard('teacher')->attempt($credentials)) {
                return redirect()->route('teacher.login')->withInput($request->only('email'))->withErrors(['email' => 'The provided credentials do not match our records.']);
            }

            $request->session()->regenerate();

            return redirect()->intended('teacher/dashboard')->with('success','Login Successful');

        }

        return view('backend.auth.teacher-login');
    }

    public function teacherLogout(Request $request){

        Auth::guard('teacher')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('teacher.login');
    }
}
