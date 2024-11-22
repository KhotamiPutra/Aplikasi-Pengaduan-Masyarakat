<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengaduan Masyarakat</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white min-h-screen">
    <div class="max-w-7xl mx-auto p-8">
        <!-- Letterhead (Kop) -->
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

        <!-- Report Header -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold mb-2">LAPORAN PENGADUAN MASYARAKAT</h1>
            <p class="text-sm">
                Periode: {{ request('start_date') ? date('d F Y', strtotime(request('start_date'))) : 'Semua' }}
                s/d {{ request('end_date') ? date('d F Y', strtotime(request('end_date'))) : 'Sekarang' }}
            </p>
        </div>

        <!-- Complaints Table -->
        <table class="w-full border-collapse mb-8">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2 text-left">No.</th>
                    <th class="border px-4 py-2 text-left">Tanggal</th>
                    <th class="border px-4 py-2 text-left">NIK</th>
                    <th class="border px-4 py-2 text-left">Nama</th>
                    <th class="border px-4 py-2 text-left">Isi Laporan</th>
                    <th class="border px-4 py-2 text-left">Status</th>
                    <th class="border px-4 py-2 text-left">Tanggapan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengaduans as $index => $pengaduan)
                <tr>
                    <td class="border px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border px-4 py-2">{{ date('d/m/Y', strtotime($pengaduan->tgl_pengaduan)) }}</td>
                    <td class="border px-4 py-2">{{ $pengaduan->nik }}</td>
                    <td class="border px-4 py-2">{{ $pengaduan->putra_masyarakat->nama ?? 'Anonim' }}</td>
                    <td class="border px-4 py-2">{{ Str::limit($pengaduan->isi_laporan, 100) }}</td>
                    <td class="border px-4 py-2">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                            {{ $pengaduan->status == '0' ? 'bg-yellow-100 text-yellow-800' :
                               ($pengaduan->status == 'proses' ? 'bg-blue-100 text-blue-800' :
                               'bg-green-100 text-green-800') }}">
                            {{ $pengaduan->status == '0' ? 'Menunggu' :
                               ($pengaduan->status == 'proses' ? 'Proses' : 'Selesai') }}
                        </span>
                    </td>
                    <td class="border px-4 py-2">
                        @if($pengaduan->putra_tanggapan->isNotEmpty())
                            {{ Str::limit($pengaduan->putra_tanggapan->last()->tanggapan, 100) }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Footer -->
        <div class="text-right mb-8">
            <p class="text-sm">Total Laporan: {{ $pengaduans->count() }}</p>
            <p class="text-sm">Dicetak pada: {{ date('d F Y H:i:s') }}</p>
        </div>

        <!-- Print Buttons -->
        <div class="flex justify-center gap-4 print:hidden">
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

