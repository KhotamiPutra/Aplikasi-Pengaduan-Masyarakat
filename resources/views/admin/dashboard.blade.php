@extends('layouts.dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Card: Total Pengaduan -->
    <div class="bg-white border border-[#f3e7e2] shadow-lg rounded-xl p-6 flex items-center gap-4 hover:shadow-xl transition">
        <div class="bg-[#D97757]/10 rounded-full p-4">
            <svg class="h-8 w-8 text-[#D97757]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </div>
        <div>
            <h2 class="text-base font-semibold text-[#D97757] mb-1">Total Pengaduan</h2>
            <p class="text-3xl font-bold text-gray-800">{{ $putra_total_pengaduan }}</p>
        </div>
    </div>
    <!-- Card: Pengaduan Minggu Ini -->
    <div class="bg-white border border-[#f3e7e2] shadow-lg rounded-xl p-6 flex items-center gap-4 hover:shadow-xl transition">
        <div class="bg-[#D97757]/10 rounded-full p-4">
            <svg class="h-8 w-8 text-[#D97757]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 17l4 4 4-4m-4-5v9"/>
            </svg>
        </div>
        <div>
            <h2 class="text-base font-semibold text-[#D97757] mb-1">Pengaduan Minggu Ini</h2>
            <p class="text-3xl font-bold text-gray-800">{{ $putra_total_minggu_ini }}</p>
        </div>
    </div>
    <!-- Card: Pengaduan Selesai -->
    <div class="bg-white border border-[#f3e7e2] shadow-lg rounded-xl p-6 flex items-center gap-4 hover:shadow-xl transition">
        <div class="bg-[#D97757]/10 rounded-full p-4">
            <svg class="h-8 w-8 text-[#D97757]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <div>
            <h2 class="text-base font-semibold text-[#D97757] mb-1">Pengaduan Selesai</h2>
            <p class="text-3xl font-bold text-gray-800">{{ $putra_pengaduan_selesai }}</p>
        </div>
    </div>
</div>

<!-- Info Ringkas -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white border border-[#f3e7e2] shadow-lg rounded-xl p-6 flex flex-col justify-center items-center">
        <h3 class="text-lg font-semibold text-[#D97757] mb-4">Pengaduan Belum Diproses</h3>
        <div class="flex items-center gap-4">
            <div class="bg-yellow-100 text-yellow-700 rounded-full p-4">
                <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 19a7 7 0 100-14 7 7 0 000 14z"/>
                </svg>
            </div>
            <span class="text-3xl font-bold">{{ $putra_total_pengaduan - $putra_pengaduan_selesai }}</span>
        </div>
        <div class="text-gray-700 text-sm mt-2">Total pengaduan yang belum selesai diproses</div>
    </div>
    <div class="bg-white border border-[#f3e7e2] shadow-lg rounded-xl p-6 flex flex-col justify-center items-center">
        <h3 class="text-lg font-semibold text-[#D97757] mb-4">Persentase Pengaduan Selesai</h3>
        @php
            $total = $putra_total_pengaduan ?? 0;
            $selesai = $putra_pengaduan_selesai ?? 0;
            $percent = $total > 0 ? round(($selesai / $total) * 100, 1) : 0;
        @endphp
        <div class="relative w-32 h-32 flex items-center justify-center mb-2">
            <svg class="absolute top-0 left-0 w-full h-full" viewBox="0 0 100 100">
                <circle cx="50" cy="50" r="45" fill="none" stroke="#f3e7e2" stroke-width="10"/>
                <circle cx="50" cy="50" r="45" fill="none" stroke="#D97757" stroke-width="10"
                    stroke-dasharray="282.6"
                    stroke-dashoffset="{{ 282.6 - ($percent/100)*282.6 }}"
                    stroke-linecap="round"
                    transform="rotate(-90 50 50)"/>
            </svg>
            <span class="text-3xl font-bold text-[#D97757]">{{ $percent }}%</span>
        </div>
        <div class="text-gray-700 text-sm">Selesai dari total pengaduan</div>
    </div>
</div>

<!-- Table Section -->
<div class="bg-white border border-[#f3e7e2] shadow-lg rounded-xl overflow-x-auto">
    <div class="p-6 border-b">
        <h3 class="text-xl font-semibold text-[#D97757]">Data Pengaduan Terbaru</h3>
    </div>
    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="px-6 py-3 border-b text-left text-sm font-semibold text-gray-700">NIK</th>
                <th class="px-6 py-3 border-b text-left text-sm font-semibold text-gray-700">Nama Pelapor</th>
                <th class="px-6 py-3 border-b text-left text-sm font-semibold text-gray-700">Isi laporan</th>
                <th class="px-6 py-3 border-b text-left text-sm font-semibold text-gray-700">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($putra_pengaduan_terbaru as $pengaduan)
            <tr class="hover:bg-[#D97757]/10 transition">
                <td class="px-6 py-4 border-b text-sm text-gray-600">{{ $pengaduan->nik }}</td>
                <td class="px-6 py-4 border-b text-sm text-gray-600">{{ $pengaduan->user->nama}}</td>
                <td class="px-6 py-4 border-b text-sm text-gray-600">{{ $pengaduan->isi_laporan }}</td>
                <td class="px-6 py-4 border-b text-sm">
                    @if($pengaduan->status == '0')
                        <span class="inline-block px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">Baru</span>
                    @elseif($pengaduan->status == 'proses')
                        <span class="inline-block px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">Diproses</span>
                    @elseif($pengaduan->status == 'selesai')
                        <span class="inline-block px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">Selesai</span>
                    @else
                        <span class="inline-block px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-semibold">{{ ucfirst($pengaduan->status) }}</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
