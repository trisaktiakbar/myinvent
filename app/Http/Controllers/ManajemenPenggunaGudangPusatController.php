<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ManajemenPenggunaGudangPusatController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'Gudang Pusat')->where('subsidiary_id', Auth::user()->subsidiary_id)->orderBy('name')->get();
        return view('manajemen-pengguna.gudang-pusat.index', compact('users'));
    }

    public function create()
    {
        return view('manajemen-pengguna.gudang-pusat.create');
    }

    public function store(Request $req)
    {
        $req->validate([
            'subsidiary_id' => Auth::user()->subsidiary_id,
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', Rule::unique('users')->where(function ($query) use ($req) {
                return $query->where('subsidiary_id', Auth::user()->subsidiary_id);
            })],
            'password' => ['required', Rules\Password::defaults()],
            'konfirmasi_password' => ['required', 'same:password']
        ]);

        User::create([
            'name' => $req->nama_lengkap,
            'username' => Str::lower($req->username),
            'password' => Hash::make($req->password),
            'role' => 'Gudang Pusat',
        ]);

        return redirect()->route('manajemen-pengguna.gudang-pusat.index')->withHeaders(['Cache-Control' => 'no-store']);
    }

    public function edit(Request $req)
    {
        $user = User::where('role', 'Gudang Pusat')->where('username', $req->username)->where('subsidiary_id', Auth::user()->subsidiary_id)->firstOrfail();
        return view('manajemen-pengguna.gudang-pusat.edit', compact('user'));
    }

    public function update(Request $req)
    {
        $user = User::where('role', 'Gudang Pusat')->where('username', $req->route('username'))->where('subsidiary_id', Auth::user()->subsidiary_id)->firstOrFail();

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

        return redirect()->route('manajemen-pengguna.gudang-pusat.edit', $user->username)->withHeaders(['Cache-Control' => 'no-store']);
    }

    public function resetPassword(Request $req)
    {
        $user = User::where('role', 'Gudang Pusat')->where('username', $req->username)->where('subsidiary_id', Auth::user()->subsidiary_id)->firstOrFail();
        $req->validate([
            'password' => ['required', Rules\Password::defaults()],
            'konfirmasi_password' => ['required', 'same:password']
        ]);

        $user->update([
            'password' => Hash::make($req->password),
        ]);

        return redirect()->back()->withHeaders(['Cache-Control' => 'no-store']);
    }

    public function destroy(Request $req)
    {
        $user = User::where('role', 'Gudang Pusat')->where('username', $req->username)->where('subsidiary_id', Auth::user()->subsidiary_id)->firstOrfail();
        $user->delete();

        return redirect()->back();
    }
}
