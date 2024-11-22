@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-4">Data Masyarakat</h2>

        <a href="{{ route('masyarakat.create') }}" class="px-4 py-2 bg-[#D97757] text-white rounded hover:bg-[#bf6443]">
            Tambah Masyarakat
        </a>
        <div class="mb-4"></div>
        @if (session('success'))
            <div id="success-alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel Data Masyarakat -->
        <table class="table-auto w-full mt-4">
            <thead>
                <tr>
                    <th class="px-4 py-2">NIK</th>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Username</th>
                    <th class="px-4 py-2">Telp</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($putra_masyarakat as $putra_m)
                    <tr>
                        <td class="border px-4 py-2">{{ $putra_m->nik }}</td>
                        <td class="border px-4 py-2">{{ $putra_m->nama }}</td>
                        <td class="border px-4 py-2">{{ $putra_m->username }}</td>
                        <td class="border px-4 py-2">{{ $putra_m->telp }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('masyarakat.edit', $putra_m->nik) }}" class="hover:scale-110 p-1 rounded">
                                <img src="{{ asset('asset/images/pen (1).png') }}" alt="Edit" class="inline-block mr-2">
                            </a>
                            <form action="{{ route('masyarakat.destroy', $putra_m->nik) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="hover:scale-110 p-1 rounded">
                                    <img src="{{ asset('asset/images/delete.png') }}" alt="Delete" class="inline-block">
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
