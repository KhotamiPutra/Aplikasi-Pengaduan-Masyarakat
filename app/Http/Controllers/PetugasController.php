<?php

namespace App\Http\Controllers;

use App\Models\actifitylog;
use App\Models\masyarakat;
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
            'putra_telp' => 'required|string',
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

    public function buatdashboardadmin()
    {
        $putra_total_pengaduan = Pengaduan::count();
        $putra_total_pengaduan = Pengaduan::count();
        $putra_total_minggu_ini = Pengaduan::whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ])->count();
        $putra_pengaduan_terbaru = Pengaduan::with('user')
            ->latest()
            ->take(10)
            ->get();
        $putra_pengaduan_selesai = Pengaduan::where('status', 'selesai')->count();
        return view('admin.dashboard', [
            'putra_total_pengaduan' => $putra_total_pengaduan,
            'putra_total_minggu_ini' => $putra_total_minggu_ini,
            'putra_pengaduan_terbaru' => $putra_pengaduan_terbaru,
            'putra_pengaduan_selesai' => $putra_pengaduan_selesai
        ]);
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

    public function buatdashboardpetugas()
    {
        $putra_total_pengaduan = Pengaduan::count();
        $putra_total_pengaduan = Pengaduan::count();
        $putra_total_minggu_ini = Pengaduan::whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ])->count();
        $putra_pengaduan_terbaru = Pengaduan::with('user')
            ->latest()
            ->take(10)
            ->get();
        $putra_pengaduan_selesai = Pengaduan::where('status', 'selesai')->count();
        return view('Petugas.dashboard', [
            'putra_total_pengaduan' => $putra_total_pengaduan,
            'putra_total_minggu_ini' => $putra_total_minggu_ini,
            'putra_pengaduan_terbaru' => $putra_pengaduan_terbaru,
            'putra_pengaduan_selesai' => $putra_pengaduan_selesai
        ]);
    }
    //================================================================
    public function HapusLaporanMasyarakat($putra_idLaporan)
    {
        $putra_pengaduan = pengaduan::findOrFail($putra_idLaporan);
        $putra_pengaduan->delete();

        $putra_idAdmin = Auth::guard('petugas')->user()->id_petugas;
        $putra_namaAdmin = Auth::guard('petugas')->user()->nama_petugas;
        $user_type = 'petugas';
        if (Auth::guard('petugas')->check()) {
            $user_type = 'petugas';
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

    public function Laporan(Request $putra_request)
    {
        $query = Pengaduan::query();

        if ($putra_request->filled('status')) {
            $query->where('status', $putra_request->status);
        }

        if ($putra_request->filled('start_date')) {
            $query->where('tgl_pengaduan', '>=', $putra_request->start_date);
        }

        if ($putra_request->filled('end_date')) {
            $query->where('tgl_pengaduan', '<=', $putra_request->end_date);
        }

        $putra_pengaduans = $query->orderBy('tgl_pengaduan', 'desc')->get();

        return view('admin.report', compact('putra_pengaduans'));
    }

    public function print($putra_id)
    {
        $putra_pengaduan = Pengaduan::with(['putra_masyarakat', 'putra_tanggapan' => function ($putra_query) {
            $putra_query->with('putra_petugas');
        }])->findOrFail($putra_id);

        return view('admin.print', compact('putra_pengaduan'));
    }

    public function printAll(Request $putra_request)
    {
        $putra_query = Pengaduan::with(['putra_masyarakat', 'putra_tanggapan' => function ($putra_query) {
            $putra_query->with('putra_petugas');
        }]);

        if ($putra_request->filled('status')) {
            $putra_query->where('status', $putra_request->status);
        }

        if ($putra_request->filled('start_date')) {
            $putra_query->where('tgl_pengaduan', '>=', $putra_request->start_date);
        }

        if ($putra_request->filled('end_date')) {
            $putra_query->where('tgl_pengaduan', '<=', $putra_request->end_date);
        }

        $putra_pengaduans = $putra_query->orderBy('tgl_pengaduan', 'desc')->get();

        return view('admin.print-all', compact('putra_pengaduans'));
    }

    public function cari(Request $putra_request)
    {
        $putra_cari = $putra_request->get('putra_cari');

        if ($putra_cari) {
            $putra_petugas = Petugas::where('nama_petugas', 'like', '%' . $putra_cari . '%')
                ->orWhere('username', 'like', '%' . $putra_cari . '%')
                ->get();
        } else {
            $putra_petugas = Petugas::all();
        }

        return view('admin.MasterPetugas', compact('putra_petugas'));
    }
}
