{{-- resources/views/Masyarakat/detailLaporan.blade.php --}}
@extends('layouts.pengaduanLayout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6 text-center">Detail Laporan</h2>

    @if ($putra_pengaduan->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($putra_pengaduan as $pp)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h3 class="font-semibold text-lg mb-2">Laporan {{ $loop->iteration }}</h3>
                        <p class="text-gray-600 mb-4">
                            <span class="font-medium">Tanggal:</span> {{ $pp->tgl_pengaduan }}
                        </p>
                        <p class="text-gray-700 mb-4">{{ $pp->isi_laporan }}</p>

                        @if ($pp->foto)
                            <img src="{{ asset('storage/' . $pp->foto) }}" alt="Foto Laporan" class="w-full h-48 object-cover mb-4 rounded">
                        @else
                            <p class="text-gray-500 mb-4">Tidak ada foto</p>
                        @endif

                        <!-- Tanggapan Section -->
                        <div class="mt-4 mb-4">
                            <h4 class="font-medium text-gray-800 mb-2">Tanggapan:</h4>
                            @if($pp->putra_tanggapan->count() > 0)
                                @foreach($pp->putra_tanggapan as $tanggapan)
                                    <div class="bg-gray-50 p-3 rounded mb-2">
                                        <div class="flex justify-between items-start mb-1">
                                            <span class="text-sm font-medium text-blue-600">{{ $tanggapan->putra_petugas->username }}</span>
                                            <span class="text-xs text-gray-500">{{ $tanggapan->tgl_tanggapan }}</span>
                                        </div>
                                        <p class="text-sm text-gray-700">{{ $tanggapan->tanggapan }}</p>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-sm text-gray-500">Belum ada tanggapan</p>
                            @endif
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="px-3 py-1 text-xs font-medium rounded-full
                                {{ $pp->status == '0' ? 'bg-yellow-100 text-yellow-800' :
                                   ($pp->status == 'proses' ? 'bg-blue-100 text-blue-800' :
                                   'bg-green-100 text-green-800') }}">
                                {{ $pp->status == '0' ? 'Menunggu' :
                                   ($pp->status == 'proses' ? 'Diproses' : 'Selesai') }}
                            </span>

                            <div class="flex justify-end space-x-2">
                                <form action="{{ route('laporan.destroy', $pp->id_pengaduan) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition duration-300">
                                        Hapus
                                    </button>
                                </form>
                                @if(Auth::guard('petugas')->check())
                                <button onclick="openTanggapanModal({{ $pp->id_pengaduan }})"
                                    class="bg-[#D97757] hover:bg-[#bf6443] text-white px-3 py-1 rounded transition duration-300">
                                    Tanggapan
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-gray-700">Anda belum melaporkan apapun</p>
    @endif
</div>

<!-- Modal Tanggapan -->
<div id="tanggapanModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Berikan Tanggapan</h3>
            <form id="tanggapanForm" method="POST">
                @csrf
                <textarea name="tanggapan" class="w-full border rounded p-2 mb-4" rows="4" placeholder="Tulis tanggapan..."></textarea>

                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeTanggapanModal()"
                        class="bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded">
                        Batal
                    </button>
                    <button type="submit"
                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                        Kirim
                    </button>
                </div>
            </form>

            <!-- Riwayat Tanggapan dalam Modal -->
            <div class="mt-6">
                <h4 class="font-medium text-gray-800 mb-2">Riwayat Tanggapan:</h4>
                <div id="riwayatTanggapan" class="max-h-60 overflow-y-auto">
                    <!-- Riwayat tanggapan akan diisi melalui JavaScript -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function openTanggapanModal(id_pengaduan) {
        const modal = document.getElementById('tanggapanModal');
        const form = document.getElementById('tanggapanForm');
        const riwayatContainer = document.getElementById('riwayatTanggapan');

        // Set form action URL
        form.action = `/tanggapan/${id_pengaduan}`;

        // Fetch existing tanggapan
        fetch(`/tanggapan/${id_pengaduan}/get`)
            .then(response => response.json())
            .then(data => {
                riwayatContainer.innerHTML = data.map(t => `
                    <div class="bg-gray-50 p-3 rounded mb-2">
                        <div class="flex justify-between items-start mb-1">
                            <span class="text-sm font-medium text-blue-600">${t.putra_petugas.username}</span>
                            <span class="text-xs text-gray-500">${t.tgl_tanggapan}</span>
                        </div>
                        <p class="text-sm text-gray-700">${t.tanggapan}</p>
                    </div>
                `).join('');
            });

        modal.classList.remove('hidden');
    }
</script>
@endpush
