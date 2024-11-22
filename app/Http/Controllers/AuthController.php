<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate(
            [
                'putra_nik' => 'required|unique:masyarakat,nik|size:16',
                'putra_nama' => 'required|max:35',
                'putra_username' => [
                    'required',
                    'max:25',
                    Rule::unique('masyarakat', 'username'),
                    Rule::unique('petugas', 'username')
                ],
                'putra_password' => 'required|min:6|max:32',
                'putra_telp' => 'required|max:13'
            ],
            [
                'putra_nik.unique' => 'nik sudah di gunakan',
                'putra_nik.size' => 'nik harus 16 character',
                'putra_username.unique' => 'username sudah digunakan'
            ]

        );

        Masyarakat::create([
            'nik' => $request->putra_nik,
            'nama' => $request->putra_nama,
            'username' => $request->putra_username,
            'password' => Hash::make($request->putra_password),
            'telp' => $request->putra_telp
        ]);
        toast('Berhasil registrasi silahkan login', 'success');
        return redirect(route('login'));
    }
    public function login(Request $putra_request)
{
    $putra_request->validate([
        'putra_username' => 'required',
        'putra_password' => 'required',
    ]);

    $user = Petugas::where('username', $putra_request->putra_username)->first();

    if ($user) {
        if (Hash::check($putra_request->putra_password, $user->password)) {
            if ($user->level == 'admin') {
                Auth::guard('petugas')->login($user);
                toast('Selamat datang!', 'success');
                return redirect('/admin');
            } elseif ($user->level == 'petugas') {
                Auth::guard('petugas')->login($user);
                toast('Selamat datang!', 'success');
                return redirect('/petugas');
            } else {
                Auth::guard('masyarakat')->login($user);
                toast('Selamat datang!', 'success');
                return redirect('/masyarakat');
            }
        }
    } else {
        $user = Masyarakat::where('username', $putra_request->putra_username)->first();
        if ($user) {
            if (Hash::check($putra_request->putra_password, $user->password)) {
                Auth::guard('masyarakat')->login($user);
                toast('Selamat datang!', 'success');
                return redirect('/masyarakat');
            }else{
                toast('Username atau password salah', 'error');
                return redirect()->back();
            }
        }
    }
    toast('User tidak ditemukan', 'error');
    return redirect()->back();
}

    public function logout()
    {
        Session::flush();
        toast('Logout berhasil', 'success');
        return redirect(route('login'));
    }
}
