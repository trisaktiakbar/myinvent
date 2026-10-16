<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index()
    {


        return view('profil.index');
    }

    public function update(Request $req)
    {
        $user = User::where('username', Auth::user()->username)->firstOrFail();

        $req->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
        ]);

        if ($req->username != $user->username) {
            $req->validate(['username' => ['required', 'string', 'unique:' . User::class]]);
        }

        $user->update([
            'name' => $req->nama_lengkap,
            'username' => Str::lower($req->username),
        ]);

        return redirect()->back();
    }
}
