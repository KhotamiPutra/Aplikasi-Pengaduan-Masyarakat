<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard petugas - Pengaduan Masyarakat</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Sidebar -->
        <div class="flex flex-col w-64 bg-[#D97757] text-white h-full fixed">
            <div class="px-6 py-4 font-bold text-2xl">Petugas Dashboard</div>
            <nav class="flex-1 px-4 py-2 space-y-2">
                <a href="{{ route('petugasIndex') }}"
                    class="flex items-center block px-4 py-2 rounded hover:bg-[#bf6443]">
                    <img src="{{ asset('asset/images/layout.png') }}" alt="Dashboard Icon" class="w-5 h-5 mr-2">
                    Dashboard
                </a>
                <a href="#" onclick="toggleSubMenu('pengaturanSubMenu')"
                    class="flex items-center block px-4 py-2 rounded hover:bg-[#bf6443]">
                    <img src="{{ asset('asset/images/complain.png') }}" alt="Dashboard Icon"
                        class="w-5 h-5 mr-2">Pengaduan
                </a>
                <div id="pengaturanSubMenu" class="hidden pl-4 space-y-2">
                    <a href="{{ route('Petugaslaporan.index', ['status' => '0']) }}"
                        class="flex items-center block px-4 py-2 rounded hover:bg-[#bf6443]"> <img
                            src="{{ asset('asset/images/new-product.png') }}" alt="Dashboard Icon"
                            class="w-5 h-5 mr-2">Pengaduan
                        Terbaru</a>
                    <a href="{{ route('Petugaslaporan.index', ['status' => 'proses']) }}"
                        class="flex items-center block px-4 py-2 rounded hover:bg-[#bf6443]"><img
                            src="{{ asset('asset/images/engineering.png') }}" alt="Dashboard Icon"
                            class="w-5 h-5 mr-2">Pengaduan Diproses</a>
                    <a href="{{ route('Petugaslaporan.index', ['status' => 'selesai']) }}"
                        class="flex items-center block px-4 py-2 rounded hover:bg-[#bf6443]"><img
                            src="{{ asset('asset/images/checkbox.png') }}" alt="Dashboard Icon"
                            class="w-5 h-5 mr-2">Pengaduan Selesai</a>
                </div>
            </nav>
        </div>

        <script>
            function toggleSubMenu(id) {
                const menu = document.getElementById(id);
                if (menu.classList.contains('hidden')) {
                    menu.classList.remove('hidden');
                } else {
                    menu.classList.add('hidden');
                }
            }
        </script>


        <!-- Main Content -->
        <div class="ml-64 flex-1 p-6">
            <!-- Header -->
            <header class="flex justify-between items-center bg-white shadow-md p-4 mb-6 rounded">
                <h1 class="text-2xl font-bold text-gray-700">Selamat
                    Datang,{{ Auth::guard('petugas')->user()->nama_petugas }}</h1>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="button" class="bg-[#D97757] text-white px-4 py-2 rounded hover:bg-[#bf6443]"
                        onclick="return confirm('Apakah Anda yakin ingin logout?') ? document.forms[0].submit() : false;">
                        Logout
                    </button>
                </form>
            </header>
            <!-- Main Area -->
            @include('sweetalert::alert')
            <main>
                @yield('content')
            </main>
        </div>
    </div>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
</body>

</html>
