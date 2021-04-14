<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {

        $users = User::all();
        return view('user', compact('users'));
    }

    public function add()
    {
        return view('add_user');
    }

    public function insert(Request $res)
    {
        User::create([
            "name" => $res->name,
            "email" => $res->email,
            "password" => bcrypt($res->password),
            "level" => $res->level,
            "alamat" => $res->alamat,
            "hp" => $res->hp
        ]);
        return redirect('user')->with('success', "Berhasil menambahkan data!");
    }

    public function delete($id)
    {
        $users = User::destroy($id);

        return redirect('user')->with('success', "Berhasil menghapus data!");
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('edit_user', compact('user'));
    }

    public function update(Request $req)
    {
        $users = User::findOrFail($req->id);

        $users->name = $req->name;
        $users->email = $req->email;
        if (!empty($req->password)) {
            $users->password = bcrypt($req->password);
        }
        $users->level = $req->level;
        $users->alamat = $req->alamat;
        $users->hp = $req->hp;
        $users->save();

        return redirect('user')->with('success', "Data berhasil diedit!");
    }

    public function print()
    {
        $users = User::all();
        return view('user_print', compact('users'));
    }
}
