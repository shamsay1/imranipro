<?php

namespace App\Http\Controllers;

use App\Models\SystemUser;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(){
        $buyers = SystemUser::where('role','buyer')->get();
        return view('buyers',compact('buyers'));
    }
    public function store(Request $request)
{
    $request->validate([
        'firstname' => 'required',
        'middlename' => 'required',
        'lastname' => 'required',
        'gender' => 'required',
        'email' => 'required|unique:users',
        'password' => 'required',
    ]);

    SystemUser::create([
        'firstname' => $request->firstname,
        'middlename' => $request->middlename,
        'lastname' => $request->lastname,
        'email' => $request->email,
        'mobile' => $request->mobile,
        'gender' => $request->gender,
        'password' => bcrypt($request->password),
        'role' => $request->role,
    ]);

    return back()->with('success', 'Registration completed sucessfully!');
}
    public function update(Request $request, SystemUser $user)
{
    $user->update([
        'firstname' => $request->firstname,
        'middlename' => $request->middlename,
        'lastname' => $request->lastname,
        'email' => $request->email,
        'mobile' => $request->mobile,
        'gender' => $request->gender,
    ]);

    return back()->with('success','User is upated success');
}
}
