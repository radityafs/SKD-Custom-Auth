<?php

namespace App\Http\Controllers;

use App\Models\DetailModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthenticationController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:50',
            'repassword' => 'required|same:password',
            'role' => 'required|in:admin,user'
        ]);

        DB::beginTransaction();
        try {
            $User = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role,
                'is_active' => $request->role == 'admin' ? 1 : 0,
            ]);

            DetailModel::create([
                'id_user' => $User->id,
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => "Ada kesalahan di sisi server"]);
        }

        return redirect('login')->with('success', 'Berhasil mendaftar');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|max:50',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role === 'admin') {
                return redirect("/admin/dashboard");
            } else {
                if (Auth::user()->is_active == 1) {
                    return redirect("/user/dashboard");
                } else {
                    Auth::logout();
                    return redirect()->back()->withErrors(['error' => "Akun anda belum diaktifkan oleh admin"]);
                }
            }
        }

        return back()->with('error', 'Password atau email salah');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
