<?php

namespace App\Http\Controllers;

use App\Models\actifitylog;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TanggapanController extends Controller
{
    public function create($putra_id)
    {
        $putra_pengaduan = Pengaduan::findOrFail($putra_id);
        $putra_tanggapan = Tanggapan::where('id_pengaduan', $putra_id)
            ->with('putra_petugas')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.tanggapan', compact('putra_pengaduan', 'putra_tanggapan'));
    }

    public function Petugascreate($putra_id)
    {
        $putra_pengaduan = Pengaduan::findOrFail($putra_id);
        $putra_tanggapan = Tanggapan::where('id_pengaduan', $putra_id)
            ->with('putra_petugas')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('Petugas.tanggapan', compact('putra_pengaduan', 'putra_tanggapan'));
    }
    public function ambiltanggapan($putra_idpengaduan)
    {
        $putra_tanggapan = Tanggapan::where('id_pengaduan', $putra_idpengaduan)->with('putra_petugas:id_petugas,username')->orderBy('created_at', 'desc')->get();
        return response()->json($putra_tanggapan);
    }

    public function store(Request $putra_request, $putra_id_pengaduan)
    {
        $putra_request->validate([
            'putra_tanggapan' => 'required|string',
        ]);

        Tanggapan::create([
            'id_pengaduan' => $putra_id_pengaduan,
            'tgl_tanggapan' => now(),
            'tanggapan' => $putra_request->putra_tanggapan,
            'id_petugas' => Auth::guard('petugas')->id(),
        ]);

        $putra_pengaduan = Pengaduan::findOrFail($putra_id_pengaduan);
        $putra_idAdmin = Auth::guard('petugas')->user()->id_petugas;
        $putra_namaAdmin = Auth::guard('petugas')->user()->nama_petugas;
        $putra_user_type = 'petugas';
        if (Auth::guard('petugas')->check()) {
            $putra_user_type = 'admin';
        }
        actifitylog::create([
            'user_id' => $putra_idAdmin,
            'user_type' => $putra_user_type,
            'action' => 'Menanggapi Laporan',
            'description' => "{$putra_user_type} bernama {$putra_namaAdmin} telah Menanggapi laporan {$putra_pengaduan->putra_nik}"
        ]);
        toast('Tanggapan berhasil dikirim', 'success');
        return redirect()->back();
    }
}
