<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function login()
    {
        if (Auth::check() && Auth::user()->role == 3) {
            return redirect()->route('customer.dashboard');
        }
        else{
            return view('frontend.auth.login');
        }
    }
    public function register(){
        return view('frontend.auth.register');
    }

    public function loginSubmit(Request $request)
    {
//        return $request;
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:8'
        ]);

        if (Auth::attempt($request->only('email','password'))) {
            if (Auth::user()->role == 3){
                return redirect()->route('customer.dashboard');
            }
            else{
                Auth::logout();
                session()->flash('message', 'Invalid login.');
                return back();
            }
        }
        else{
            session()->flash('message', 'Incorrect Credentials.');
            return back();
        }
    }

    public function index()
    {
        return view('frontend.customer.dashboard.index');
    }
}
