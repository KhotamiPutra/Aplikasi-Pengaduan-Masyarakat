@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
            <h2 class="text-2xl font-bold text-[#D97757] mb-2 md:mb-0">Data Masyarakat</h2>
            <div class="flex flex-col md:flex-row md:items-center gap-2">
                <form method="GET" action="{{ route('cariMas.index') }}" class="flex gap-2">
                    <input type="text" name="putra_cari" value="{{ request()->get('putra_cari') }}" placeholder="Cari masyarakat..."
                        class="px-4 py-2 border border-[#D97757]/40 rounded-lg focus:ring-2 focus:ring-[#D97757] focus:outline-none transition w-48 md:w-64" />
                    <button type="submit" class="px-4 py-2 bg-[#D97757] text-white rounded-lg hover:bg-[#bf6443] transition font-semibold">
                        Cari
                    </button>
                </form>
                <a href="{{ route('masyarakat.create') }}" class="px-4 py-2 bg-[#D97757] text-white rounded-lg hover:bg-[#bf6443] transition font-semibold shadow">
                    + Tambah Masyarakat
                </a>
            </div>
        </div>
        @if (session('success'))
            <div id="success-alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 shadow">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel Data Masyarakat -->
        <div class="bg-white rounded-xl shadow-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-[#f3e7e2]">
                <thead class="bg-[#f9f6f5]">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-[#D97757] uppercase tracking-wider">NIK</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-[#D97757] uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-[#D97757] uppercase tracking-wider">Username</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-[#D97757] uppercase tracking-wider">Telp</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-[#D97757] uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-[#f3e7e2]">
                    @foreach ($putra_masyarakat as $putra_m)
                        <tr class="hover:bg-[#D97757]/10 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $putra_m->nik }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $putra_m->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $putra_m->username }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $putra_m->telp }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <a href="{{ route('masyarakat.edit', $putra_m->nik) }}" class="inline-flex items-center justify-center bg-[#D97757]/10 hover:bg-[#D97757]/20 rounded-full p-2 transition" title="Edit">
                                    <img src="{{ asset('asset/images/pen (1).png') }}" alt="Edit" class="h-5 w-5" />
                                </a>
                                <form action="{{ route('masyarakat.destroy', $putra_m->nik) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center bg-red-100 hover:bg-red-200 rounded-full p-2 transition ml-2" title="Hapus">
                                        <img src="{{ asset('asset/images/delete.png') }}" alt="Delete" class="h-5 w-5" />
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        setTimeout(() => {
            const message = document.getElementById('success-alert');
            if (message) {
                message.style.transition = "opacity 0.5s ease-out";
                message.style.opacity = "0";
                setTimeout(() => message.remove(), 500);
            }
        }, 2000);
    </script>
@endsection
