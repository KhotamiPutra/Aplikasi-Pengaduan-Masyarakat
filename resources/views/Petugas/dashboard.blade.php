@extends('layouts.petugasDashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white shadow-md rounded p-6">
        <h2 class="text-lg font-semibold mb-4 text-[#D97757]">Total Pengaduan</h2>
        <p class="text-4xl font-bold">{{ $putra_total_pengaduan }}</p>
    </div>
    <div class="bg-white shadow-md rounded p-6">
        <h2 class="text-lg font-semibold mb-4 text-[#D97757]">Pengaduan Minggu Ini</h2>
        <p class="text-4xl font-bold">{{ $putra_total_minggu_ini }}</p>
    </div>
    <div class="bg-white shadow-md rounded p-6">
        <h2 class="text-lg font-semibold mb-4 text-[#D97757]">Pengaduan Selesai</h2>
        <p class="text-4xl font-bold">75</p>
    </div>
</div>

<div class="mt-8 bg-white shadow-md rounded">
    <div class="p-6 border-b">
        <h3 class="text-xl font-semibold text-[#D97757]">Data Pengaduan Terbaru</h3>
    </div>
    <table class="min-w-full bg-white border">
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
            <tr>
                <td class="px-6 py-4 border-b text-sm text-gray-600">{{ $pengaduan->nik }}</td>
                <td class="px-6 py-4 border-b text-sm text-gray-600">{{ $pengaduan->user->nama}}</td>
                <td class="px-6 py-4 border-b text-sm text-gray-600">{{ $pengaduan->isi_laporan }}</td>
                <td class="px-6 py-4 border-b text-sm text-gray-600">{{ $pengaduan->status }}</td>
                <td class="px-6 py-4 border-b text-center">
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
