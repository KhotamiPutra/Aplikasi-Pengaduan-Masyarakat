<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Pengaduan Masyarakat</title>
    @vite('resources/css/app.css')
    <style>
        /* Modern sidebar styles */
        .sidebar-link {
            transition: all 0.2s cubic-bezier(.4,0,.2,1);
            border-radius: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.01em;
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            position: relative;
            color: #D97757;
        }

        .sidebar-link:hover, .sidebar-link:focus {
            background: rgba(217,119,87,0.08);
            color: #D97757;
            box-shadow: 0 2px 8px 0 rgba(217,119,87,0.04);
        }

        .sidebar-link.active {
            background: #D97757;
            color: #fff !important;
            border-left: 5px solid #D97757;
            box-shadow: 0 2px 12px 0 rgba(217,119,87,0.07);
        }

        .sidebar-link svg {
            opacity: 0.85;
        }

        .submenu-transition {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s cubic-bezier(.4,0,.2,1);
        }

        .submenu-transition.open {
            max-height: 500px;
        }

        /* Submenu modern card style */
        .sidebar-submenu-card {
            background: rgba(217,119,87,0.06);
            border-radius: 0.75rem;
            margin: 0.25rem 0 0.5rem 0;
            box-shadow: 0 1px 6px 0 rgba(217,119,87,0.04);
            border-left: 4px solid #D97757;
            padding: 0.5rem 0.25rem 0.5rem 0.5rem;
        }

        .sidebar-submenu-card .sidebar-link {
            border-radius: 0.5rem;
            font-size: 0.97rem;
            margin-bottom: 0.15rem;
            padding-left: 2.25rem;
            color: #D97757;
        }

        .sidebar-submenu-card .sidebar-link.active {
            background: #D97757;
            color: #fff !important;
            border-left: 3px solid #D97757;
        }

        /* Custom scrollbar for sidebar */
        .sidebar-scroll::-webkit-scrollbar {
            width: 5px;
        }
        .sidebar-scroll::-webkit-scrollbar-track {
            background: rgba(217,119,87,0.08);
        }
        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: rgba(217,119,87,0.25);
            border-radius: 4px;
        }

        /* Sidebar background and shadow */
        #sidebar {
            background: #fff;
            box-shadow: 2px 0 24px 0 rgba(217,119,87,0.08), 0 2px 8px 0 rgba(0,0,0,0.04);
            border-top-right-radius: 1.5rem;
            border-bottom-right-radius: 1.5rem;
        }

        /* User profile section */
        .sidebar-profile {
            background: rgba(217,119,87,0.08);
            border-radius: 1rem;
            padding: 1rem 0.75rem;
            margin: 1.5rem 1rem 0.5rem 1rem;
            box-shadow: 0 1px 8px 0 rgba(217,119,87,0.04);
        }

        /* Responsive sidebar width */
        @media (min-width: 1024px) {
            #sidebar {
                width: 280px;
            }
            .lg\:ml-64 {
                margin-left: 280px !important;
            }
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex flex-col">
        <!-- Mobile Sidebar Toggle -->
        <div class="lg:hidden fixed top-4 left-4 z-50">
            <button id="mobile-toggle" class="bg-[#D97757] text-white p-2 rounded-md shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Sidebar -->
        <div id="sidebar" class="flex flex-col w-72 text-[#D97757] h-screen fixed left-0 top-0 z-40 shadow-xl transform transition-transform duration-300 ease-in-out lg:translate-x-0 -translate-x-full">
            <!-- Logo and Brand -->
            <div class="px-8 py-7 flex items-center justify-center border-b border-[#D97757]/20">
                <img src="{{ asset('asset/images/logo.png') }}" alt="Logo" class="h-28 w-auto object-contain" />
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-5 space-y-1 overflow-y-auto sidebar-scroll">
                <!-- Dashboard -->
                <a href="{{ route('adminIndex') }}" class="sidebar-link px-4 py-3 {{ request()->routeIs('adminIndex') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    <span>Dashboard</span>
                </a>
                <!-- Masyarakat -->
                <a href="{{ route('MasterMasyarakat') }}" class="sidebar-link px-4 py-3 {{ request()->routeIs('MasterMasyarakat') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span>Masyarakat</span>
                </a>
                <!-- Data Petugas -->
                <a href="{{ route('MasterPetugas') }}" class="sidebar-link px-4 py-3 {{ request()->routeIs('MasterPetugas') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>Data Petugas</span>
                </a>
                <!-- Pengaduan with Submenu -->
                <div class="space-y-1">
                    <button type="button" onclick="toggleSubMenu('pengaduanSubMenu')" class="sidebar-link w-full justify-between px-4 py-3 {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <span>Pengaduan</span>
                        </div>
                        <svg id="pengaduanArrow" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <!-- Submenu -->
                    <div id="pengaduanSubMenu" class="submenu-transition {{ request()->routeIs('laporan.*') ? 'open' : '' }}">
                        <div class="sidebar-submenu-card">
                            <a href="{{ route('laporan.index', ['status' => '0']) }}" class="sidebar-link px-4 py-2 {{ request()->is('*/laporan*') && request()->query('status') == '0' ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                <span>Pengaduan Terbaru</span>
                            </a>
                            <a href="{{ route('laporan.index', ['status' => 'proses']) }}" class="sidebar-link px-4 py-2 {{ request()->is('*/laporan*') && request()->query('status') == 'proses' ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                <span>Pengaduan Diproses</span>
                            </a>
                            <a href="{{ route('laporan.index', ['status' => 'selesai']) }}" class="sidebar-link px-4 py-2 {{ request()->is('*/laporan*') && request()->query('status') == 'selesai' ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Pengaduan Selesai</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Aktivitas -->
                <a href="{{ route('activity-logs.index') }}" class="sidebar-link px-4 py-3 {{ request()->routeIs('activity-logs.index') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span>Aktivitas</span>
                </a>
                <!-- Laporan -->
                <a href="{{ route('report.index') }}" class="sidebar-link px-4 py-3 {{ request()->routeIs('report.index') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>Laporan</span>
                </a>
            </nav>
            <!-- User Profile Section -->
            <div class="sidebar-profile flex items-center space-x-3">
                <div class="bg-[#D97757]/10 rounded-full p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#D97757]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold truncate text-[#D97757]">{{ Auth::guard('petugas')->user()->nama_petugas }}</p>
                    <p class="text-xs text-[#D97757]/70 truncate">Admin</p>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-[#D97757] hover:text-[#c96a4c]" onclick="return confirm('Apakah Anda yakin ingin logout?')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:ml-64 flex-1 transition-all duration-300 ease-in-out">
            <!-- Header -->
            <header class="bg-white shadow-md p-4 mb-6 rounded-lg mx-4 mt-4 flex justify-between items-center">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-gray-700">Selamat Datang, {{ Auth::guard('petugas')->user()->nama_petugas }}</h1>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="relative">
                        <button class="text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Main Area -->
            <main class="px-4 pb-6">
                @include('sweetalert::alert')
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Toggle submenu function
        function toggleSubMenu(id) {
            const menu = document.getElementById(id);
            const arrow = document.getElementById('pengaduanArrow');

            if (menu.classList.contains('open')) {
                menu.classList.remove('open');
                arrow.classList.remove('rotate-180');
            } else {
                menu.classList.add('open');
                arrow.classList.add('rotate-180');
            }
        }

        // Mobile sidebar toggle
        document.getElementById('mobile-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
            } else {
                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('-translate-x-full');
            }
        });

        // Initialize submenu state based on active route
        document.addEventListener('DOMContentLoaded', function() {
            // Check if any submenu item is active
            const activeSubItem = document.querySelector('#pengaduanSubMenu .sidebar-link.active');
            if (activeSubItem) {
                const subMenu = document.getElementById('pengaduanSubMenu');
                const arrow = document.getElementById('pengaduanArrow');

                subMenu.classList.add('open');
                arrow.classList.add('rotate-180');
            }
        });

        // SweetAlert for logout confirmation
        function confirmLogout(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan keluar dari sistem.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#D97757',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Logout!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.closest('form').submit();
                }
            });
        }
    </script>

    <!-- Include SweetAlert if needed -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
