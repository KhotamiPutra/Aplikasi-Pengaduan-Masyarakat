@extends('layouts.dashboard')
@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="p-8">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-bold text-gray-800">Edit Masyarakat</h2>
                    <a href="{{ route('MasterMasyarakat') }}" class="text-gray-500 hover:text-gray-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                </div>

                <form action="{{ route('masyarakat.update', $putra_masyarakat->nik) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1 space-y-1">
                            <label for="putra_nik" class="block text-sm font-medium text-gray-700">
                                NIK
                            </label>
                            <input
                                type="text"
                                id="putra_nik"
                                value="{{ $putra_masyarakat->nik }}"
                                disabled
                                class="mt-1 block w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-900 text-sm cursor-not-allowed"
                                placeholder="NIK"
                            />
                            <p class="mt-1 text-xs text-gray-500">NIK tidak dapat diubah</p>
                        </div>
                        <div class="flex-1 space-y-1">
                            <label for="putra_nama" class="block text-sm font-medium text-gray-700">
                                Nama
                            </label>
                            <input
                                type="text"
                                id="putra_nama"
                                name="putra_nama"
                                value="{{ old('putra_nama', $putra_masyarakat->nama) }}"
                                class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-900 text-sm transition duration-150 ease-in-out focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('putra_nama') border-red-500 bg-red-50 @enderror"
                                placeholder="Nama"
                            />
                            @error('putra_nama')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label for="putra_username" class="block text-sm font-medium text-gray-700">
                            Username
                        </label>
                        <input
                            type="text"
                            id="putra_username"
                            name="putra_username"
                            value="{{ old('putra_username', $putra_masyarakat->username) }}"
                            class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-900 text-sm transition duration-150 ease-in-out focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('putra_username') border-red-500 bg-red-50 @enderror"
                            placeholder="Username"
                        />
                        @error('putra_username')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="putra_password" class="block text-sm font-medium text-gray-700">
                            Password
                        </label>
                        <div class="relative">
                            <input
                                type="password"
                                id="putra_password"
                                name="putra_password"
                                class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-900 text-sm transition duration-150 ease-in-out focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('putra_password') border-red-500 bg-red-50 @enderror"
                                placeholder="Kosongkan jika tidak ingin mengubah password"
                            />
                            <button
                                type="button"
                                onclick="togglePassword()"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" id="password-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ingin mengubah password</p>
                        @error('putra_password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="putra_telp" class="block text-sm font-medium text-gray-700">
                            Telepon
                        </label>
                        <input
                            type="text"
                            id="putra_telp"
                            name="putra_telp"
                            value="{{ old('putra_telp', $putra_masyarakat->telp) }}"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-900 text-sm transition duration-150 ease-in-out focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('putra_telp') border-red-500 bg-red-50 @enderror"
                            placeholder="Nomor Telepon"
                        />
                        @error('putra_telp')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4 flex items-center justify-end space-x-4">
                        <button type="submit"
                            class="px-6 py-3 bg-[#D97757] rounded-lg text-white text-sm font-medium transition-colors duration-150 ease-in-out hover:bg-[#e9815e] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('putra_password');
        const passwordIcon = document.getElementById('password-icon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
            `;
        } else {
            passwordInput.type = 'password';
            passwordIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            `;
        }
    }
</script>
@endsection
