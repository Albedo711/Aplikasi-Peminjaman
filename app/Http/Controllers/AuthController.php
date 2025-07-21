<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(){
        return view('register');
    }

    public function registerPost(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string',
            'role' => 'required|string|in:admin,user',
            'kelas' => 'required_if:role,user|string|in:X,XI,XII', 
            'jurusan' => 'required_if:role,user|string|in:RPL,PSPT,ANIMASI,TJKT,TE', 
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;

       
        if ($request->role == 'user') {
            $user->kelas = $request->kelas;
            $user->jurusan = $request->jurusan;
        }

        $user->save();

        return back()->with('success', 'Register successfully');
    }

    public function login(){
        return view('login');
    }

    public function loginPost(Request $request){
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'name' => $request->name,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)){
            return redirect('/dashboard')->with('success', 'Login berhasil');
        }

        return back()->with('error', 'Login error');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success','Logout berhasil');
    }
    
}
