<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;

class MainController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function login()
    {
        return view('admin.login');
    }

    public function loginAction(AdminLoginRequest $request)
    {
        \Auth::attempt($request->only('email', 'password'), $request->input('rememberme'));

        return redirect()->route('admin.dashboard');
    }
}
