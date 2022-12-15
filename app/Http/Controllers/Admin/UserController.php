<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegistrationRequest;
use App\Http\Requests\UserDataRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(RegistrationRequest $request)
    {
        return is_array(\App\Facades\User::registration($request->input('email'))) ?
            redirect()->route('admin.users.index')->with(['success' => 'Success! User created']) :
            redirect()->route('admin.users.index')->with(['error' => 'Something went wrong...']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.users.edit', compact('user'));
    }

    public function update(UserDataRequest $request, $id)
    {
        \App\Facades\User::updateData($request->full(), $id);

        return redirect()->route('admin.users.index')->with('message', 'User data updated');
    }

    public function destroy($id)
    {
        User::whereId($id)->delete();

        return redirect()->route('admin.users.index')->with(['message' => 'User was deleted']);
    }
}
