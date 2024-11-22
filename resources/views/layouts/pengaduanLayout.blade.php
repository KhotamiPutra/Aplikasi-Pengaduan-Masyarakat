<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Layanan Aspirasi dan Pengaduan Online Rakyat</title>
    @vite('resources/css/app.css')
</head>

<body>
    <nav class="bg-white shadow-md fixed top-0 left-0 right-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <a href="#"
                        class="text-xl font-bold text-[#D97757] hover:text-[#D97757]/80 transition duration-300">
                        Laporan
                    </a>
                </div>

                <div class="hidden md:flex space-x-6">
                    <a href="{{ route('masyarakatIndex') }}"
                        class="text-gray-700 hover:text-[#D97757] transition duration-300">Beranda</a>
                    <a href="{{ route('putra_detailPengaduan') }}"
                        class="text-gray-700 hover:text-[#D97757] transition duration-300">Detail</a>
                    <a href="#" class="text-gray-700 hover:text-[#D97757] transition duration-300">Status
                        Laporan</a>
                    <a href="{{ route('panduan') }}" class="text-gray-700 hover:text-[#D97757] transition duration-300">Panduan</a>
                </div>

                <div class="relative group">
                    <div class="flex items-center cursor-pointer group">
                        <span class="mr-2 text-gray-700 group-hover:text-[#D97757] transition">
                            {{ Auth::guard('masyarakat')->user()->nama }}
                        </span>
                        <svg class="w-5 h-5 text-gray-500 group-hover:text-[#D97757] transition" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>

                    <div
                        class="absolute right-0 mt-2 w-48 bg-white border rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out">
                        <a href="#"
                            onclick="return confirm('Apakah Anda yakin ingin logout?') ? window.location.href = '{{ route('logoutmasyarakat') }}' : false;"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    @include('sweetalert::alert')
    <div class="min-h-screen">
        @yield('content')
    </div>

    <!-- Progress Tracker -->
    <div class="container mx-auto px-4 py-12">
        <div class="flex justify-between max-w-4xl mx-auto">
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 rounded-full bg-[#D97757] flex items-center justify-center text-white mb-2">
                    ✍️
                </div>
                <span class="text-sm text-center">Tulis Laporan</span>
            </div>
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center mb-2">
                    🔍
                </div>
                <span class="text-sm text-center">Proses Verifikasi</span>
            </div>
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center mb-2">
                    📋
                </div>
                <span class="text-sm text-center">Proses Tindak Lanjut</span>
            </div>
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center mb-2">
                    💬
                </div>
                <span class="text-sm text-center">Beri Tanggapan</span>
            </div>
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center mb-2">
                    ✅
                </div>
                <span class="text-sm text-center">Selesai</span>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
