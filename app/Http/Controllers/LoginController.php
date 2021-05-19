<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function showFormLogin() {
        return view('admin.login');
    }

    function login(Request $request) {
        $data = $request->only(['email','password']);
        if (!Auth::attempt($data)) {
            session()->flash('login_error', 'Tai khoan mat khau khong dung');
            return back();
        }

        return redirect()->route('admin.dahsboard');
    }
}
