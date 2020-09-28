<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('Login.index');
    }
    public function login(Request  $request){
//        dd($request->all());
        request()->validate([
//            'email' => 'required|string|email|max:255|exists:staff,email',
            'email' => 'required',
            'password' => 'required',
        ]);
        $year=$request->login_year;
        $credentials = $request->only('email', 'password');
        if (Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password,
        ])) {
            return redirect('user')->with('year',$request->login_year);
        }
        return redirect('/');
    }
    public function logout() {
        Auth::logout();
        return Redirect('login');
    }
}
