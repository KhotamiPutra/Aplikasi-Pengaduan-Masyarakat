@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-4">Data Petugas</h2>

        <a href="{{ route('petugas.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Tambah petugas
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
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Username</th>
                    <th class="px-4 py-2">Telp</th>
                    <th class="px-4 py-2">Level</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($putra_petugas as $putra_m)
                    <tr>
                        <td class="border px-4 py-2">{{ $putra_m->nama_petugas }}</td>
                        <td class="border px-4 py-2">{{ $putra_m->username }}</td>
                        <td class="border px-4 py-2">{{ $putra_m->telp }}</td>
                        <td class="border px-4 py-2">{{ $putra_m->level }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('petugas.edit', $putra_m->id_petugas) }}" class="hover:scale-110 p-1 rounded">
                                <img src="{{ asset('asset/images/pen (1).png') }}" alt="Edit" class="inline-block mr-2">
                            </a>
                            <form action="{{ route('petugas.destroy', $putra_m->id_petugas) }}"
                                method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
