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
    public function register(Request $putra_request)
    {
        $putra_request->validate(
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
            'nik' => $putra_request->putra_nik,
            'nama' => $putra_request->putra_nama,
            'username' => $putra_request->putra_username,
            'password' => Hash::make($putra_request->putra_password),
            'telp' => $putra_request->putra_telp
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

    $putra_user = Petugas::where('username', $putra_request->putra_username)->first();

    if ($putra_user) {
        if (Hash::check($putra_request->putra_password, $putra_user->password)) {
            if ($putra_user->level == 'admin') {
                Auth::guard('petugas')->login($putra_user);
                toast('Selamat datang!', 'success');
                return redirect('/admin');
            } elseif ($putra_user->level == 'petugas') {
                Auth::guard('petugas')->login($putra_user);
                toast('Selamat datang!', 'success');
                return redirect('/petugas');
            } else {
                Auth::guard('masyarakat')->login($putra_user);
                toast('Selamat datang!', 'success');
                return redirect('/masyarakat');
            }
        }
    } else {
        $putra_user = Masyarakat::where('username', $putra_request->putra_username)->first();
        if ($putra_user) {
            if (Hash::check($putra_request->putra_password, $putra_user->password)) {
                Auth::guard('masyarakat')->login($putra_user);
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
