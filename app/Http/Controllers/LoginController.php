<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $userr = DB::table('userr')
            ->where('username', $request->username)
            ->where('email', $request->email)
            ->first();

        if ($userr && Hash::check($request->password, $userr->password)) {
            session([
                'user_id' => $userr->id,
                'username' => $userr->username,
                'role' => $userr->role,
                'is_logged_in' => true
            ]);

            return redirect()->route('dashboard');
        } else {
            return back()->with('error', 'Username, email, atau password salah!');
        }
    }


    public function logout()
    {
        session()->flush();
        return redirect()->route('dashboard');
    }

}
