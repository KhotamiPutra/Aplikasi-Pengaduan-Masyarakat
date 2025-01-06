<?php

namespace App\Http\Controllers;

use App\Models\masyarakat;
use App\Models\pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MobileAPIController extends Controller
{

    public function index()
    {
        $data = masyarakat::all();
        return response()->json([
            'message' => 'success',
            'data' => $data
        ]);
    }

    public function register(Request $request)
    {
        $data = Masyarakat::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'telp' => $request->telp,
        ]);

        return response()->json([
            'message' => 'success',
            'data' => $data,
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = masyarakat::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'username atau password salah'
            ], 401);
        }

        return response()->json([
            'message' => 'login berhasil',
            'nik' => $user->nik,
            'nama' => $user->nama,
            'username' => $user->username,
            'telp' => $user->telp
        ]);
    }
}
