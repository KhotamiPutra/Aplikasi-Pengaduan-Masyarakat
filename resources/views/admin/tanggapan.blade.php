@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6 text-center">Tanggapan Laporan</h2>

        <div class="bg-white shadow-md rounded-lg p-6">
            <p class="mb-4"><strong>Tanggal Pengaduan:</strong> {{ $putra_pengaduan->tgl_pengaduan }}</p>
            <p class="mb-4"><strong>Isi Laporan:</strong> {{ $putra_pengaduan->isi_laporan }}</p>

            <form action="{{ route('tanggapan.store', $putra_pengaduan->id_pengaduan) }}" method="POST" class="mb-8">
                @csrf
                <textarea name="putra_tanggapan" class="w-full border rounded p-2" placeholder="Tulis tanggapan..."></textarea>
                <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded mt-2 hover:bg-green-600">
                    Kirim Tanggapan
                </button>
            </form>

            <!-- Daftar Tanggapan -->
            <div class="mt-6">
                <h3 class="text-xl font-semibold mb-4">Riwayat Tanggapan</h3>
                @if($putra_tanggapan->count() > 0)
                    @foreach($putra_tanggapan as $t)
                        <div class="bg-gray-50 p-4 rounded-lg mb-4">
                            <div class="flex justify-between items-start mb-2">
                                <span class="font-medium text-blue-600">{{ $t->putra_petugas->username }}</span>
                                <span class="text-sm text-gray-500">{{ $t->tgl_tanggapan }}</span>
                            </div>
                            <p class="text-gray-700">{{ $t->tanggapan }}</p>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-500">Belum ada tanggapan</p>
                @endif
            </div>
        </div>
    </div>
@endsection
