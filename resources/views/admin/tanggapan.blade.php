@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto px-4 py-10">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-2xl shadow-xl border border-[#f3e7e2] p-8">
                <h2 class="text-3xl font-extrabold mb-8 text-[#D97757] text-center tracking-tight">Tanggapan Laporan</h2>
                <div class="mb-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                        <div>
                            <span class="block text-xs font-semibold text-gray-500">Tanggal Pengaduan</span>
                            <span class="block text-base text-gray-800">{{ $putra_pengaduan->tgl_pengaduan }}</span>
                        </div>
                        <div>
                            <span class="block text-xs font-semibold text-gray-500">Status</span>
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                {{ $putra_pengaduan->status == '0'
                                    ? 'bg-yellow-100 text-yellow-700'
                                    : ($putra_pengaduan->status == 'proses'
                                        ? 'bg-blue-100 text-blue-700'
                                        : 'bg-green-100 text-green-700') }}">
                                {{ $putra_pengaduan->status == '0' ? 'Menunggu' : ($putra_pengaduan->status == 'proses' ? 'Diproses' : 'Selesai') }}
                            </span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="block text-sm font-semibold text-[#D97757]">Isi Laporan:</span>
                        <p class="text-base text-gray-800 mt-1">{{ $putra_pengaduan->isi_laporan }}</p>
                    </div>
                </div>

                <form action="{{ route('tanggapan.store', $putra_pengaduan->id_pengaduan) }}" method="POST" class="mb-8">
                    @csrf
                    <textarea name="putra_tanggapan" class="w-full border border-[#D97757]/30 rounded-xl p-3 bg-[#f9f6f5] focus:ring-2 focus:ring-[#D97757] focus:outline-none transition placeholder-gray-400" placeholder="Tulis tanggapan..." rows="3"></textarea>
                    <div class="flex justify-end mt-3">
                        <button type="submit" class="bg-[#22c55e] hover:bg-[#16a34a] text-white px-6 py-2 rounded-lg font-semibold text-sm shadow transition">
                            Kirim Tanggapan
                        </button>
                    </div>
                </form>

                <!-- Daftar Tanggapan -->
                <div class="mt-8">
                    <h3 class="text-xl font-bold text-[#D97757] mb-4">Riwayat Tanggapan</h3>
                    @if($putra_tanggapan->count() > 0)
                        <div class="space-y-4">
                            @foreach($putra_tanggapan as $t)
                                <div class="bg-[#f9f6f5] border border-[#f3e7e2] p-4 rounded-xl shadow-sm">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="font-semibold text-[#D97757]">{{ $t->putra_petugas->username }}</span>
                                        <span class="text-xs text-gray-500">{{ $t->tgl_tanggapan }}</span>
                                    </div>
                                    <p class="text-gray-700">{{ $t->tanggapan }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">Belum ada tanggapan</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
