<?php

namespace App\Http\Controllers;

use App\Models\pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $putra_pengaduan = pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('Masyarakat.detailLaporan', compact('putra_pengaduan'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Masyarakat.lapor');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $putra_request)
{
    // $putra_request->validate([
    //     'putra_tanggal' => 'required|date',
    //     'putra_laporan' => 'required',
    //     'putra_gambar' => 'required|max:2048', // Validasi untuk file gambar
    // ]);
    $putra_request->validate([
        'putra_gambar' => 'required',
    ]);

    $putra_fotoPath = null;

    if ($putra_request->hasFile('putra_gambar')) {
        $putra_file = $putra_request->file('putra_gambar');
        $putra_extension = $putra_file->getClientOriginalExtension();
        $putra_filenameToStore = Auth::guard('masyarakat')->user()->nama . '_' . time() . '.' . $putra_extension;
        $putra_fotoPath = $putra_file->storeAs('pengaduan', $putra_filenameToStore, 'public');
    }

    pengaduan::create([
        'nik' => $putra_request->putra_nik,
        'tgl_pengaduan' => $putra_request->putra_tanggal,
        'isi_laporan' => $putra_request->putra_laporan,
        'foto' => $putra_fotoPath,
        'status' => '0'
    ]);

    toast('Laporan berhasil dikirim', 'success');
    return redirect()->route('masyarakatIndex');
}

    public function destroy($putra_idLaporan)
{
    $putra_pengaduan = pengaduan::findOrFail($putra_idLaporan);
    if ($putra_pengaduan->status != '0') {
        toast('Laporan tidak dapat dihapus karena sudah diproses.', 'error');
        return redirect()->route('putra_detailPengaduan');
    }
    $putra_pengaduan->delete();
    toast('Laporan berhasil dihapus', 'success');
    return redirect()->route('laporan.index');
}

}
