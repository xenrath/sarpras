<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        if (auth()->check()) {
            return redirect('cek-login');
        } else {
            return view('login');
        }
    }

    public function login_proses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'telp' => 'required',
            'password' => 'required',
        ], [
            'telp.required' => 'Nomor Telepon harus diisi!',
            'password.required' => 'Password harus diisi!',
        ]);

        if ($validator->fails()) {
            alert()->error('Gagal!', 'Isi data dengan benar!');
            return back()->withInput();
        }

        if (Auth::attempt(['telp' => $request->telp, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect('cek-login');
        } else {
            alert()->error('Gagal!', 'Nomor Telepon atau Password salah!');
            return back()->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('login');
    }
}
