<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function showLogin() {
        return view('login');
    }

    public function authenticate(Request $request) {
        $credentials = $request->validate([
           'email' => ['required', 'email'],
           'password'  => ['required']
        ]);
        $credentials['deleted_at'] = null;

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('after_login');
        }

        return redirect()->route('login.show_login')->withErrors([
           'email' => '認証失敗しました。再度入力してください。'
        ])->onlyInput('email');
    }

    public function afterLogin() {
        return view('after_login');
    }
}
