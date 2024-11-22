<?php

namespace App\Http\Controllers;

use App\Models\actifitylog;
use App\Models\pengaduan;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index()
    {
        $putra_petugas = Petugas::all();
        return view('admin.MasterPetugas', compact('putra_petugas'));
    }

    public function create()
    {
        return view('admin.PetugasAdd');
    }

    public function store(Request $putra_request)
    {
        // dd($putra_idAdmin);
        $putra_request->validate([
            'putra_nama' => 'required|string|max:35',
            'putra_username' => [
                'required',
                'string',
                'max:25',
                'unique:petugas,username',
                'unique:masyarakat,username'
            ],
            'putra_password' => 'required|string|min:6',
            'putra_telp' => 'required|string|max:13',
            'putra_level' => 'required'
        ]);

        Petugas::create([
            'nama_petugas' => $putra_request->putra_nama,
            'username' => $putra_request->putra_username,
            'password' => Hash::make($putra_request->putra_password),
            'telp' => $putra_request->putra_telp,
            'level' => $putra_request->putra_level
        ]);


        $putra_idAdmin = Auth::guard('petugas')->user()->id_petugas;
        $putra_namaAdmin = Auth::guard('petugas')->user()->nama_petugas;
        actifitylog::create([
            'user_id' => $putra_idAdmin,
            'user_type' => 'admin',
            'action' => 'Menambahkan Petugas',
            'description' => "Petugas bernama {$putra_namaAdmin} telah menambahkan petugas bernama {$putra_request->putra_nama} dengan username {$putra_request->putra_username} sebagai {$putra_request->putra_level}"
        ]);
        toast('Data petugas berhasil ditambahkan', 'success');
        return redirect()->route('MasterPetugas');
    }


    public function edit(string $putra_idPetugas)
    {
        $putra_petugas = Petugas::findOrFail($putra_idPetugas);
        return view('admin.PetugasEdit', compact('putra_petugas'));
    }

    public function update(Request $putra_request, string $putra_idPetugas)
    {
        $putra_request->validate([
            'putra_nama' => 'required|string|max:35',
            'putra_username' => [
                'required',
                'string',
                'max:25',
                'unique:petugas,username,' . $putra_idPetugas . ',id_petugas',
                'unique:masyarakat,username'
            ],
            'putra_telp' => 'required|string|max:13',
            'putra_level' => 'required'
        ]);

        $putra_petugas = Petugas::findOrFail($putra_idPetugas);

        $putra_petugas->update([
            'nama_petugas' => $putra_request->putra_nama,
            'username' => $putra_request->putra_username,
            'telp' => $putra_request->putra_telp,
            'level' => $putra_request->putra_level
        ]);

        if ($putra_request->filled('putra_password')) {
            $putra_petugas->update([
                'password' => Hash::make($putra_request->putra_password)
            ]);
        }

        $putra_idAdmin = Auth::guard('petugas')->user()->id_petugas;
        $putra_namaAdmin = Auth::guard('petugas')->user()->nama_petugas;
        actifitylog::create([
            'user_id' => $putra_idAdmin,
            'user_type' => 'admin',
            'action' => 'Mengupdate Petugas',
            'description' => "Petugas bernama {$putra_namaAdmin} telah mengupdate petugas bernama {$putra_request->putra_nama}"
        ]);
        toast('Data petugas berhasil diperbarui', 'success');
        return redirect()->route('MasterPetugas');
    }

    public function destroy(string $putra_idPetugas, Request $putra_request)
    {
        $putra_petugas = Petugas::findOrFail($putra_idPetugas);
        $putra_petugas->delete();

        $putra_idAdmin = Auth::guard('petugas')->user()->id_petugas;
        $putra_namaAdmin = Auth::guard('petugas')->user()->nama_petugas;
        actifitylog::create([
            'user_id' => $putra_idAdmin,
            'user_type' => 'admin',
            'action' => 'Menambahkan Petugas',
            'description' => "Petugas bernama {$putra_namaAdmin} telah menghapus petugas bernama"
        ]);
        toast('Data petugas berhasil dihapus', 'success');
        return redirect()->route('MasterPetugas');
    }

    public function AmbilLaporan($putra_stastus)
    {
        $putra_pengaduan = pengaduan::with('putra_masyarakat')->where('status', $putra_stastus)->get();
        switch ($putra_stastus) {
            case '0':
                return view('admin.LaporanTerbaru', compact('putra_pengaduan'));
            case 'proses':
                return view('admin.LaporanProses', compact('putra_pengaduan'));
            case 'selesai':
                return view('admin.LaporanSelesai', compact('putra_pengaduan'));
            default:
                return view('admin.LaporanTerbaru', compact('putra_pengaduan'));
        }
    }
    public function PetugasAmbilLaporan($putra_stastus)
    {
        $putra_pengaduan = pengaduan::with('putra_masyarakat')->where('status', $putra_stastus)->get();
        switch ($putra_stastus) {
            case '0':
                return view('Petugas.LaporanTerbaru', compact('putra_pengaduan'));
            case 'proses':
                return view('Petugas.LaporanProses', compact('putra_pengaduan'));
            case 'selesai':
                return view('Petugas.LaporanSelesai', compact('putra_pengaduan'));
            default:
                return view('Petugas.LaporanTerbaru', compact('putra_pengaduan'));
        }
    }
    //admin======================================================
    public function konfirmasiLaporan($putra_idLaporan)
    {
        $putra_pengaduan = pengaduan::findOrFail($putra_idLaporan);
        $putra_pengaduan->update([
            'status' => 'proses'
        ]);

        $putra_idAdmin = Auth::guard('petugas')->user()->id_petugas;
        $putra_namaAdmin = Auth::guard('petugas')->user()->nama_petugas;
        actifitylog::create([
            'user_id' => $putra_idAdmin,
            'user_type' => 'admin',
            'action' => 'Mengkonfirmasi Laporan',
            'description' => "Petugas bernama {$putra_namaAdmin} telah mengkonfirmasi laporan {$putra_pengaduan->putra_nik}"
        ]);

        toast('Laporan berhasil dikonfirmasi', 'success');
        return redirect()->back();
    }
    public function LaporanSelesaiAdmin($putra_idLaporan)
    {
        $putra_pengaduan = pengaduan::findOrFail($putra_idLaporan);
        $putra_pengaduan->update([
            'status' => 'selesai'
        ]);

        $putra_idAdmin = Auth::guard('petugas')->user()->id_petugas;
        $putra_namaAdmin = Auth::guard('petugas')->user()->nama_petugas;
        actifitylog::create([
            'user_id' => $putra_idAdmin,
            'user_type' => 'admin',
            'action' => 'Menyelesaikan Laporan',
            'description' => "Petugas bernama {$putra_namaAdmin} telah menyelesaikan laporan {$putra_pengaduan->putra_nik}"
        ]);

        toast('Laporan Selesai', 'success');
        return redirect()->back();
    }
    //petugas=============================================================
    public function konfirmasiLaporanPet($putra_idLaporan)
    {
        $putra_pengaduan = pengaduan::findOrFail($putra_idLaporan);
        $putra_pengaduan->update([
            'status' => 'proses'
        ]);

        $putra_idAdmin = Auth::guard('petugas')->user()->id_petugas;
        $putra_namaAdmin = Auth::guard('petugas')->user()->nama_petugas;
        actifitylog::create([
            'user_id' => $putra_idAdmin,
            'user_type' => 'petugas',
            'action' => 'Mengkonfirmasi Laporan',
            'description' => "Petugas bernama {$putra_namaAdmin} telah mengkonfirmasi laporan {$putra_pengaduan->putra_nik}"
        ]);

        toast('Laporan berhasil dikonfirmasi', 'success');
        return redirect()->back();
    }
    public function LaporanSelesaiPet($putra_idLaporan)
    {
        $putra_pengaduan = pengaduan::findOrFail($putra_idLaporan);
        $putra_pengaduan->update([
            'status' => 'selesai'
        ]);

        $putra_idAdmin = Auth::guard('petugas')->user()->id_petugas;
        $putra_namaAdmin = Auth::guard('petugas')->user()->nama_petugas;
        actifitylog::create([
            'user_id' => $putra_idAdmin,
            'user_type' => 'petugas',
            'action' => 'Mengkonfirmasi Laporan',
            'description' => "Petugas bernama {$putra_namaAdmin} telah mengkonfirmasi laporan {$putra_pengaduan->putra_nik}"
        ]);

        toast('Laporan Selesai', 'success');
        return redirect()->back();
    }

    public function HapusLaporanMasyarakat($putra_idLaporan)
    {
        $putra_pengaduan = pengaduan::findOrFail($putra_idLaporan);
        $putra_pengaduan->delete();

        $putra_idAdmin = Auth::guard('petugas')->user()->id_petugas;
        $putra_namaAdmin = Auth::guard('petugas')->user()->nama_petugas;
        $user_type = 'petugas';
        if(Auth::guard('admin')->check()){
            $user_type = 'admin';
        }
        actifitylog::create([
            'user_id' => $putra_idAdmin,
            'user_type' => $user_type,
            'action' => 'Mengkonfirmasi Laporan',
            'description' => "{$user_type} bernama {$putra_namaAdmin} telah mengkonfirmasi laporan {$putra_pengaduan->putra_nik}"
        ]);

        toast('Laporan berhasil dihapus', 'success');
        return redirect()->back();
    }

    public function Laporan(Request $request)
    {
        $query = Pengaduan::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('start_date')) {
            $query->where('tgl_pengaduan', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->where('tgl_pengaduan', '<=', $request->end_date);
        }

        $pengaduans = $query->orderBy('tgl_pengaduan', 'desc')->get();

        return view('admin.report', compact('pengaduans'));
    }

    public function print($id)
    {
        $pengaduan = Pengaduan::with(['putra_masyarakat', 'putra_tanggapan' => function($query) {
            $query->with('petugas');
        }])->findOrFail($id);

        return view('admin.print', compact('pengaduan'));
    }

    public function printAll(Request $request)
    {
        $query = Pengaduan::with(['putra_masyarakat', 'putra_tanggapan' => function($query) {
            $query->with('putra_petugas');
        }]);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('start_date')) {
            $query->where('tgl_pengaduan', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->where('tgl_pengaduan', '<=', $request->end_date);
        }

        $pengaduans = $query->orderBy('tgl_pengaduan', 'desc')->get();

        return view('admin.print-all', compact('pengaduans'));
    }
}
