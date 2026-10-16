<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GantiPasswordController extends Controller
{
    public function index()
    {
        return view('ganti-password.index');
    }

    public function update(Request $req)
    {
        $user = User::where('username', Auth::user()->username)->firstOrFail();

        $req->validate([
            'password_lama' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('Password lama yang Anda masukkan tidak cocok');
                }
            },],
            'password_baru' => ['required', Rules\Password::defaults()],
            'konfirmasi_password' => ['required', 'same:password_baru']
        ]);

        $user->update([
            'password' => Hash::make($req->password_baru),
        ]);

        return redirect()->back()->withHeaders(['Cache-Control' => 'no-store']);
    }
}
