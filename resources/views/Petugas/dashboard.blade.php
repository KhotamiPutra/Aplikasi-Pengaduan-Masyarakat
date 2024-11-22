@extends('layouts.petugasDashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Card 1: Jumlah Pengaduan -->
    <div class="bg-white shadow-md rounded p-6">
        <h2 class="text-lg font-semibold mb-4 text-[#D97757]">Jumlah Pengaduan</h2>
        <p class="text-4xl font-bold">120</p>
    </div>
    <!-- Card 2: Pengaduan Diproses -->
    <div class="bg-white shadow-md rounded p-6">
        <h2 class="text-lg font-semibold mb-4 text-[#D97757]">Pengaduan Diproses</h2>
        <p class="text-4xl font-bold">45</p>
    </div>
    <!-- Card 3: Pengaduan Selesai -->
    <div class="bg-white shadow-md rounded p-6">
        <h2 class="text-lg font-semibold mb-4 text-[#D97757]">Pengaduan Selesai</h2>
        <p class="text-4xl font-bold">75</p>
    </div>
</div>
<!-- Table Data Pengaduan -->
<div class="mt-8 bg-white shadow-md rounded">
    <div class="p-6 border-b">
        <h3 class="text-xl font-semibold text-[#D97757]">Data Pengaduan</h3>
    </div>
    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="px-6 py-3 border-b text-left text-sm font-semibold text-gray-700">ID</th>
                <th class="px-6 py-3 border-b text-left text-sm font-semibold text-gray-700">Nama Pelapor</th>
                <th class="px-6 py-3 border-b text-left text-sm font-semibold text-gray-700">Kategori</th>
                <th class="px-6 py-3 border-b text-left text-sm font-semibold text-gray-700">Status</th>
                <th class="px-6 py-3 border-b text-center text-sm font-semibold text-gray-700">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Contoh Data Pengaduan -->
            <tr>
                <td class="px-6 py-4 border-b text-sm text-gray-600">1</td>
                <td class="px-6 py-4 border-b text-sm text-gray-600">Andi</td>
                <td class="px-6 py-4 border-b text-sm text-gray-600">Kebersihan</td>
                <td class="px-6 py-4 border-b text-sm text-gray-600">Diproses</td>
                <td class="px-6 py-4 border-b text-center">
                    <button class="bg-[#D97757] text-white px-3 py-1 rounded hover:bg-[#bf6443]">Detail</button>
                </td>
            </tr>
            <!-- Tambahkan data lain di sini -->
        </tbody>
    </table>
</div>
@endsection
