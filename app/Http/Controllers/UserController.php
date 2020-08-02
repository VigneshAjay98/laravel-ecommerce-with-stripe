<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;

class UserController extends Controller
{
   
    public function getCredentials()
    {
        return view('register');
    }

    public function postCredentials(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = new User([
            'name' =>$request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        $user->save();
        Auth::login($user);
        return redirect()->route('home');
    }

    public function getUserInfo()
    {
        return view('login');
    }

    public function postUserInfo(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'min:8']
        ]);

        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ])){
        	return redirect()->route('home');
        }
        return redirect()->back();
    }

    public function getProfile()
    {
        $orders = Auth::user()->orders;
        $orders->transform(function($order, $key){
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return view('profile', ['orders' => $orders]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
