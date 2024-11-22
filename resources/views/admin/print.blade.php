<style>
    @media print {
        @page {
            size: A4;
            margin: 0;
        }

        body {
            margin: 0;
        }

        .print-hidden {
            display: none;
        }
    }
</style>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengaduan #{{ $pengaduan->id_pengaduan }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white min-h-screen">
    <div class="max-w-4xl mx-auto p-8">
        <!-- Header -->
        <div class="text-center border-b-2 border-black pb-6 mb-8">
            <div class="flex items-center justify-center mb-4">
                <img src="{{ asset('asset/images/images-removebg-preview.png') }}" alt="Logo" class="w-24 h-auto mr-4">
                <div class="text-left">
                    <h1 class="text-lg font-bold">PEMERINTAH KABUPATEN BANDUNG</h1>
                    <h2 class="text-base">DINAS KOMUNIKASI, INFORMATIKA DAN STATISTIK</h2>
                    <h3 class="text-base font-semibold">LAPOR MAS</h3>
                    <p class="text-sm">LAYANAN PENGADUAN MASYARAKAT</p>
                    <p class="text-xs mt-1">Jl. Raya Soreang KM.17, Pamekaran, Kec. Soreang, Kabupaten Bandung</p>
                    <p class="text-xs">Telepon: (022) 5897237 | Email: diskominfo@bandungkab.go.id</p>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="mb-8">
            <!-- Profil Pelapor -->
            <div class="mb-6">
                <h3 class="font-bold border-b pb-2 mb-4">A. Profil Pelapor</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex">
                        <span class="w-32 font-semibold">Nama Pelapor</span>
                        <span>: {{ $pengaduan->putra_masyarakat->nama ?? 'Anonim' }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-32 font-semibold">NIK</span>
                        <span>: {{ $pengaduan->nik }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-32 font-semibold">No Hp</span>
                        <span>: {{ $pengaduan->putra_masyarakat->telp ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Informasi Pengaduan -->
            <div class="mb-6">
                <h3 class="font-bold border-b pb-2 mb-4">B. Informasi Pengaduan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex">
                        <span class="w-32 font-semibold">Nomor Pengaduan</span>
                        <span>: {{ $pengaduan->id_pengaduan }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-32 font-semibold">Tanggal Pengaduan</span>
                        <span>: {{ \Carbon\Carbon::parse($pengaduan->tgl_pengaduan)->translatedFormat('l, d F Y') }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-32 font-semibold">Status Pengaduan</span>
                        <span>:
                            <span class="px-3 py-1 rounded-full text-sm font-semibold
                                {{ $pengaduan->status == '0' ? 'bg-yellow-100 text-yellow-800' :
                                   ($pengaduan->status == 'proses' ? 'bg-blue-100 text-blue-800' :
                                   'bg-green-100 text-green-800') }}">
                                {{ $pengaduan->status == '0' ? 'Menunggu' :
                                   ($pengaduan->status == 'proses' ? 'Proses' : 'Selesai') }}
                            </span>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Isi Laporan -->
            <div class="mb-6">
                <h3 class="font-bold border-b pb-2 mb-4">C. Isi Laporan</h3>
                <p class="text-justify">{{ $pengaduan->isi_laporan }}</p>
            </div>

            <!-- Bukti Laporan -->
            @if($pengaduan->foto)
            <div class="mb-6 flex">
                <div class="mr-4">
                    <h3 class="font-bold border-b pb-2 mb-4">D. Bukti Laporan</h3>
                    <img src="{{ asset('storage/'.$pengaduan->foto) }}"
                         alt="Bukti foto pengaduan"
                         class="w-40 h-auto rounded-lg shadow-md">
                    <p class="text-sm text-gray-600 mt-2">Bukti foto pengaduan - {{ \Carbon\Carbon::parse($pengaduan->tgl_pengaduan)->translatedFormat('d F Y') }}</p>
                </div>
            </div>
            @endif

            <!-- Tanggapan -->
            @if($pengaduan->putra_tanggapan->isNotEmpty())
            <div class="mb-6">
                <h3 class="font-bold border-b pb-2 mb-4">E. Tanggapan</h3>
                @foreach($pengaduan->putra_tanggapan as $tanggapan)
                <div class="mb-4 p-4 bg-gray-50 rounded-lg">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-semibold">{{ $tanggapan->petugas->nama_petugas }}</span>
                        <span class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($tanggapan->tgl_tanggapan)->translatedFormat('d F Y') }}</span>
                    </div>
                    <p>{{ $tanggapan->tanggapan }}</p>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Footer -->
        <div class="mt-9 text-right">
            <p class="text-sm text-gray-600">Bandung, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p class="text-sm text-gray-600">Pelapor,</p>
            <div class="h-16"></div>
            <p class="font-semibold -mt-1">{{ $pengaduan->putra_masyarakat->nama ?? 'Anonim' }}</p>
        </div>

        <!-- Print Buttons -->
        <div class="mt-8 flex justify-center gap-4 print:hidden">
            <button onclick="window.print()"
                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                Cetak Laporan
            </button>
            <button onclick="window.close()"
                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">
                Tutup
            </button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.print();
        });
    </script>
</body>
</html>

