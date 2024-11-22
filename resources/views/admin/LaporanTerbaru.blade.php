@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6 text-center">Laporan Terbaru</h2>

        @if ($putra_pengaduan->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($putra_pengaduan as $pengaduan)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">''
                        <div class="p-4">
                            <div class="mb-2">
                                <span class="text-sm font-semibold text-gray-600">Tanggal Pengaduan:</span>
                                <span class="text-sm text-gray-800 ml-2">{{ $pengaduan->tgl_pengaduan }}</span>
                            </div>
                            <div class="mb-2">
                                <span class="text-sm font-semibold text-gray-600">Isi Laporan:</span>
                                <p class="text-sm text-gray-800 mt-1">{{ $pengaduan->isi_laporan }}</p>
                            </div>
                            <div class="mb-2">
                                <span class="text-sm font-semibold text-gray-600">Foto:</span>
                                @if ($pengaduan->foto)
                                    <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto Laporan" class="mt-1 h-40 w-full object-cover rounded">
                                @else
                                    <p class="text-sm text-gray-800 mt-1">Tidak ada foto</p>
                                @endif
                            </div>
                            <div class="mb-2">
                                <span class="text-sm font-semibold text-gray-600">Status:</span>
                                <span class="ml-2 px-2 py-1 text-xs font-medium rounded-full
                                    {{ $pengaduan->status == '0'
                                        ? 'bg-yellow-100 text-yellow-800'
                                        : ($pengaduan->status == 'proses'
                                            ? 'bg-blue-100 text-blue-800'
                                            : 'bg-green-100 text-green-800') }}">
                                    {{ $pengaduan->status == '0' ? 'Menunggu' : ($pengaduan->status == 'proses' ? 'Diproses' : 'Selesai') }}
                                </span>
                            </div>
                            <div class="mb-2">
                                <span class="text-sm font-semibold text-gray-600">NIK:</span>
                                <span class="text-sm text-gray-800 ml-2">{{ $pengaduan->putra_masyarakat->nik ?? '-' }}</span>
                            </div>
                            <div class="mb-4">
                                <span class="text-sm font-semibold text-gray-600">Username:</span>
                                <span class="text-sm text-gray-800 ml-2">{{ $pengaduan->putra_masyarakat->username ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <a href="{{ route('laporan.konfirmasi', $pengaduan->id_pengaduan) }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-sm">Proses Laporan</a>
                                <a href="{{ route('laporanMasyarakat.hapus', $pengaduan->id_pengaduan) }}" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-sm" onclick="return confirm('Yakin ingin menghapus laporan ini?')">Hapus</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-700">Belum ada laporan</p>
        @endif
    </div>
@endsection

