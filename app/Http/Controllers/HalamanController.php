<?php

namespace App\Http\Controllers;
use App\Barang;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HalamanController extends Controller
{
    public function index()
    {
        $barang = Barang::count();
        $user = User::count();
        return view('dashboard',[
            'barang' => $barang,
            'user' => $user
        ]);
    }

    public function login()
    {
        return view('login');
    }

    public function ceklogin(Request $res)
    {
        if (Auth::attempt($res->only(['email', 'password']))) {
            return redirect('dashboard');
        } else {
            return redirect('login')->with('error', "Email atau Password anda salah!");
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('login');
    }
}
