<?php

namespace App\Http\Controllers;

use App\Models\actifitylog;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TanggapanController extends Controller
{
    public function create($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $tanggapan = Tanggapan::where('id_pengaduan', $id)
            ->with('putra_petugas')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.tanggapan', compact('pengaduan', 'tanggapan'));
    }

    public function Petugascreate($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $tanggapan = Tanggapan::where('id_pengaduan', $id)
            ->with('putra_petugas')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('Petugas.tanggapan', compact('pengaduan', 'tanggapan'));
    }
    public function ambiltanggapan($putra_idpengaduan)
    {
        $putra_tanggapan = Tanggapan::where('id_pengaduan', $putra_idpengaduan)->with('putra_petugas:id_petugas,username')->orderBy('created_at', 'desc')->get();
        return response()->json($putra_tanggapan);
    }

    public function store(Request $request, $id_pengaduan)
    {
        // Validasi input
        $request->validate([
            'tanggapan' => 'required|string',
        ]);

        // Buat data tanggapan
        Tanggapan::create([
            'id_pengaduan' => $id_pengaduan,
            'tgl_tanggapan' => now(),
            'tanggapan' => $request->tanggapan,
            'id_petugas' => Auth::guard('petugas')->id(),
        ]);

        $putra_pengaduan = Pengaduan::findOrFail($id_pengaduan);
        $putra_idAdmin = Auth::guard('petugas')->user()->id_petugas;
        $putra_namaAdmin = Auth::guard('petugas')->user()->nama_petugas;
        $user_type = 'petugas';
        if (Auth::guard('petugas')->check()) {
            $user_type = 'admin';
        }
        actifitylog::create([
            'user_id' => $putra_idAdmin,
            'user_type' => $user_type,
            'action' => 'Menanggapi Laporan',
            'description' => "{$user_type} bernama {$putra_namaAdmin} telah Menanggapi laporan {$putra_pengaduan->putra_nik}"
        ]);
        toast('Tanggapan berhasil dikirim', 'success');
        // Redirect dengan pesan sukses
        return redirect()->back();
    }
}
