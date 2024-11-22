@extends('layouts.pengaduanLayout')

@section('content')
<div class="bg-gray-100 min-h-screen mt-10">
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold text-center text-[#D97757] mb-12">Panduan Aplikasi Pengaduan Masyarakat</h1>

        <div class="grid md:grid-cols-2 gap-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold text-[#D97757] mb-4">Cara Membuat Pengaduan</h2>
                <ol class="list-decimal list-inside space-y-2">
                    <li>Masuk ke akun Anda atau daftar jika belum memiliki akun.</li>
                    <li>Klik tombol "Buat Pengaduan" di halaman utama.</li>
                    <li>Isi formulir pengaduan dengan lengkap dan jelas.</li>
                    <li>Unggah foto bukti jika ada (opsional).</li>
                    <li>Klik tombol "Kirim Pengaduan" untuk mengirimkan laporan Anda.</li>
                </ol>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold text-[#D97757] mb-4">Melacak Status Pengaduan</h2>
                <ul class="list-disc list-inside space-y-2">
                    <li>Masuk ke akun Anda.</li>
                    <li>Kunjungi halaman "Riwayat Pengaduan".</li>
                    <li>Anda akan melihat daftar semua pengaduan yang telah Anda buat.</li>
                    <li>Status pengaduan akan ditampilkan di sebelah setiap laporan:
                        <ul class="list-none pl-5 mt-2 space-y-1">
                            <li><span class="inline-block w-3 h-3 rounded-full bg-yellow-400 mr-2"></span>Menunggu: Pengaduan sedang ditinjau.</li>
                            <li><span class="inline-block w-3 h-3 rounded-full bg-blue-400 mr-2"></span>Diproses: Pengaduan sedang ditangani.</li>
                            <li><span class="inline-block w-3 h-3 rounded-full bg-green-400 mr-2"></span>Selesai: Pengaduan telah diselesaikan.</li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold text-[#D97757] mb-4">Tips Membuat Pengaduan Efektif</h2>
                <ul class="list-disc list-inside space-y-2">
                    <li>Berikan detail yang jelas dan spesifik tentang masalah yang Anda alami.</li>
                    <li>Sertakan tanggal, waktu, dan lokasi kejadian jika relevan.</li>
                    <li>Unggah foto atau dokumen pendukung jika memungkinkan.</li>
                    <li>Gunakan bahasa yang sopan dan objektif.</li>
                    <li>Periksa kembali laporan Anda sebelum mengirimkannya.</li>
                </ul>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold text-[#D97757] mb-4">Kontak Bantuan</h2>
                <p class="mb-4">Jika Anda mengalami kesulitan atau memiliki pertanyaan, jangan ragu untuk menghubungi tim bantuan kami:</p>
                <ul class="space-y-2">
                    <li><strong>Email:</strong> bantuan@pengaduan.com</li>
                    <li><strong>Telepon:</strong> (021) 1234-5678</li>
                    <li><strong>Jam Kerja:</strong> Senin - Jumat, 08.00 - 17.00 WIB</li>
                </ul>
            </div>
        </div>

        <div class="mt-12 text-center">
            <a href="{{ route('masyarakatIndex') }}" class="inline-block bg-[#D97757] text-white font-semibold py-3 px-6 rounded-lg hover:bg-[#C86646] transition duration-300">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection

