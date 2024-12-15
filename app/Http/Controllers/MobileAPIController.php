<?php

namespace App\Http\Controllers;

use App\Models\masyarakat;
use App\Models\pengaduan;
use Illuminate\Http\Request;

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
        $validasi = $request->validate([
            'nik' => 'required|string|max:16|unique:masyarakat,nik',
            'nama' => 'required|string|max:255',
            'username' => 'required|string|unique:masyarakat,username',
            'password' => 'required|string|min:6',
            'telp' => 'required|numeric',
        ]);

        $data = masyarakat::create([
            'nik' => $validasi['nik'],
            'nama' => $validasi['nama'],
            'username' => $validasi['username'],
            'password' => bcrypt($validasi['password']),
            'telp' => $validasi['telp'],
        ]);

        return response()->json([
            'message' => 'success',
            'data' => $data,
        ], 201);
    }

    // $validatedData = $request->validate([
    //     'nik' => 'required|string|max:16|unique:masyarakat,nik',
    //     'nama' => 'required|string|max:255',
    //     'username' => 'required|string|unique:masyarakat,username',
    //     'password' => 'required|string|min:6',
    //     'telp' => 'required|numeric',
    // ]);
    // $validatedData['password'] = bcrypt($validatedData['password']); // Enkripsi password

    // $data = masyarakat::create($validatedData);

    // return response()->json([
    //     'message' => 'success',
    //     'data' => $data
    // ], 201);
}
