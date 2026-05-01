<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SystemUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class homeController extends Controller
{
    public function homepage(){
        $user = Auth::user();
        $products = Product::all();
        return view("welcome",compact('user','products'));
    }
    public function signUp(){
        return view("sigup");
    }
    public function Showlogin(){
        return view("login");
    }
    public function dashboard(){
        return view("dashboard");
    }
    public function login(Request $request){
        $request->validate([
            "email" => "required",
            "password" => "required"
        ]);
        $credentials = $request->only(["email","password"]);
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            if($user->role == "admin"){
                return redirect()->route('dashboard');
            }elseif($user->role == "buyer"){
            return redirect()->route('dashboard');

            }elseif($user->role=="customer"){
               return redirect()->route('homepage');

            }

        }
        else{
            return back()->with("error","wrong credential username/password");
        }
    }


}
