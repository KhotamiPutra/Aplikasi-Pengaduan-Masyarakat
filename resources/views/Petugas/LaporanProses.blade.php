@extends('layouts.petugasDashboard')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-extrabold mb-10 text-[#D97757] text-center tracking-tight">Laporan Proses</h2>

        @if ($putra_pengaduan->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($putra_pengaduan as $pengaduan)
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-[#f3e7e2] flex flex-col h-full transition hover:shadow-2xl">
                        @if ($pengaduan->foto)
                            <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto Laporan"
                                class="h-44 w-full object-cover rounded-t-2xl">
                        @else
                            <div class="h-44 w-full flex items-center justify-center bg-gray-100 text-gray-400 text-2xl rounded-t-2xl">
                                <span>Tidak ada foto</span>
                            </div>
                        @endif
                        <div class="p-6 flex flex-col flex-1">
                            <div class="mb-2 flex items-center gap-2">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $pengaduan->status == '0'
                                        ? 'bg-yellow-100 text-yellow-700'
                                        : ($pengaduan->status == 'proses'
                                            ? 'bg-blue-100 text-blue-700'
                                            : 'bg-green-100 text-green-700') }}">
                                    {{ $pengaduan->status == '0' ? 'Menunggu' : ($pengaduan->status == 'proses' ? 'Diproses' : 'Selesai') }}
                                </span>
                                <span class="text-xs text-gray-400 ml-auto">{{ $pengaduan->tgl_pengaduan }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="block text-sm font-semibold text-[#D97757]">Isi Laporan:</span>
                                <p class="text-base text-gray-800 mt-1">{{ Str::limit($pengaduan->isi_laporan, 70) }}</p>
                            </div>
                            <div class="mb-2 grid grid-cols-2 gap-2">
                                <div>
                                    <span class="block text-xs font-semibold text-gray-500">NIK</span>
                                    <span class="block text-sm text-gray-800">{{ $pengaduan->putra_masyarakat->nik ?? '-' }}</span>
                                </div>
                                <div>
                                    <span class="block text-xs font-semibold text-gray-500">Username</span>
                                    <span class="block text-sm text-gray-800">{{ $pengaduan->putra_masyarakat->username ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="flex-1"></div>
                            <div class="flex justify-between mt-6 gap-2">
                                <a href="{{ route('laporanSelesai.index', ['id_laporan' => $pengaduan->id_pengaduan]) }}"
                                    class="bg-[#22c55e] hover:bg-[#16a34a] text-white px-4 py-2 rounded-lg font-semibold text-xs shadow transition">
                                    Selesai
                                </a>
                                <a href="{{ route('laporan.tanggapan.create', $pengaduan->id_pengaduan) }}"
                                    class="bg-[#D97757] hover:bg-[#bf6443] text-white px-4 py-2 rounded-lg font-semibold text-xs shadow transition">
                                    Tanggapan
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-700 text-lg">Belum ada laporan</p>
        @endif
    </div>
@endsection
