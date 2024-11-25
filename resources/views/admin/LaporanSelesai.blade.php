@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6 text-center">Laporan Selesai</h2>

        @if ($putra_pengaduan->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($putra_pengaduan as $putra_pengaduan_item)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-4">
                            <div class="mb-2">
                                <span class="text-sm font-semibold text-gray-600">Tanggal Pengaduan:</span>
                                <span class="text-sm text-gray-800 ml-2">{{ $putra_pengaduan_item->tgl_pengaduan }}</span>
                            </div>
                            <div class="mb-2">
                                <span class="text-sm font-semibold text-gray-600">Isi Laporan:</span>
                                <p class="text-sm text-gray-800 mt-1">{{ Str::limit($putra_pengaduan_item->isi_laporan,50)  }}</p>
                            </div>
                            <div class="mb-2">
                                <span class="text-sm font-semibold text-gray-600">Foto:</span>
                                @if ($putra_pengaduan_item->foto)
                                    <img src="{{ asset('storage/' . $putra_pengaduan_item->foto) }}" alt="Foto Laporan" class="mt-1 h-40 w-full object-cover rounded">
                                @else
                                    <p class="text-sm text-gray-800 mt-1">Tidak ada foto</p>
                                @endif
                            </div>
                            <div class="mb-2">
                                <span class="text-sm font-semibold text-gray-600">Status:</span>
                                <span class="ml-2 px-2 py-1 text-xs font-medium rounded-full
                                    {{ $putra_pengaduan_item->status == '0'
                                        ? 'bg-yellow-100 text-yellow-800'
                                        : ($putra_pengaduan_item->status == 'proses'
                                            ? 'bg-blue-100 text-blue-800'
                                            : 'bg-green-100 text-green-800') }}">
                                    {{ $putra_pengaduan_item->status == '0' ? 'Menunggu' : ($putra_pengaduan_item->status == 'proses' ? 'Diproses' : 'Selesai') }}
                                </span>
                            </div>
                            <div class="mb-2">
                                <span class="text-sm font-semibold text-gray-600">NIK:</span>
                                <span class="text-sm text-gray-800 ml-2">{{ $putra_pengaduan_item->putra_masyarakat->nik ?? '-' }}</span>
                            </div>
                            <div class="mb-4">
                                <span class="text-sm font-semibold text-gray-600">Username:</span>
                                <span class="text-sm text-gray-800 ml-2">{{ $putra_pengaduan_item->putra_masyarakat->username ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <a href="{{ route('laporan.tanggapan.create', $putra_pengaduan_item->id_pengaduan) }}" class="bg-[#D97757] text-white px-3 py-1 rounded hover:bg-[#bf6443] text-sm">Tanggapan</a>
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

