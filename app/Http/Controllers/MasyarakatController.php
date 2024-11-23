<?php

namespace App\Http\Controllers;

use App\Models\masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MasyarakatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $putra_masyarakat = masyarakat::orderBy('created_at', 'desc')->get();
        return view('admin.MasterMasyarakat', compact('putra_masyarakat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.MasyarakatAdd');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $putra_request)
    {
        $putra_request->validate([
            'putra_nik' => 'required|string|size:16|unique:masyarakat,nik',
            'putra_nama' => 'required|string|max:35',
            'putra_username' => [
                'required',
                'string',
                'max:25',
                'unique:masyarakat,username',
                'unique:petugas,username'
            ],
            'putra_password' => 'required|string|min:6',
            'putra_telp' => 'required|string|max:13'
        ]);

        Masyarakat::create([
            'nik' => $putra_request->putra_nik,
            'nama' => $putra_request->putra_nama,
            'username' => $putra_request->putra_username,
            'password' => Hash::make($putra_request->putra_password),
            'telp' => $putra_request->putra_telp
        ]);
        toast('Berhasil menambahkan masyarakat', 'success');
        return redirect()->route('MasterMasyarakat');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($putra_nik)
    {
        $putra_masyarakat = Masyarakat::findOrFail($putra_nik);
        return view('admin.MasyarakatEdit', compact('putra_masyarakat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $putra_request, $putra_nik)
    {
        $putra_request->validate([
            'putra_nama' => 'required|string|max:35',
            'putra_username' => [
                'required',
                'string',
                'max:25',
                'unique:masyarakat,username,' . $putra_nik . ',nik',
                'unique:petugas,username'
            ],
            'putra_telp' => 'required|string|max:13'
        ]);

        $putra_masyarakat = Masyarakat::findOrFail($putra_nik);
        $putra_masyarakat->update([
            'nama' => $putra_request->putra_nama,
            'username' => $putra_request->putra_username,
            'telp' => $putra_request->putra_telp
        ]);

        if ($putra_request->filled('putra_password')) {
            $putra_masyarakat->update([
                'password' => Hash::make($putra_request->putra_password)
            ]);
        }
        toast('Data masyarakat berhasil diperbarui', 'success');
        return redirect()->route('MasterMasyarakat');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($putra_nik)
    {
        $putra_masyarakat = Masyarakat::findOrFail($putra_nik);
        $putra_masyarakat->delete();

        toast('Data masyarakat berhasil dihapus', 'success');
        return redirect()->route('MasterMasyarakat');
    }

    public function cariMas(Request $putra_request)
    {
        $putra_cari = $putra_request->get('putra_cari');

        if ($putra_cari) {
            $putra_masyarakat = masyarakat::where('nama', 'like', '%' . $putra_cari . '%')
                ->orWhere('username', 'like', '%' . $putra_cari . '%')
                ->get();
        } else {
            $putra_masyarakat = masyarakat::all(); // Mengambil semua data jika tidak ada pencarian
        }

        return view('admin.MasterMasyarakat', compact('putra_masyarakat')); // Pastikan menggunakan 'putra_masyarakat'
    }
}
