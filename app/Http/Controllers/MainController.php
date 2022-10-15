<?php

namespace App\Http\Controllers;

use App\Facades\User;
use App\Http\Requests\UserEmailRequest;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {}

    public function updateEmail($code)
    {
        User::changeEmail($code);

        return redirect()->route('home');
    }

    public function confirmEmail($slug)
    {
        User::confirm(\Auth::user()->email, $slug);

        return redirect()->route('home');
    }
}
