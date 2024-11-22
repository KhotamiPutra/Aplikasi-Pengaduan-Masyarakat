<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Daftar - Sistem Pengaduan Masyarakat</title>
</head>

<body class="bg-gradient-to-br from-[#D97757] to-orange-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden transform transition-all">
            <div class="p-8">
                <div class="text-center mb-8">

                    <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Buat Akun Baru</h2>
                    <p class="text-sm text-gray-600">
                        Sudah punya akun?
                        <a href="{{ route('login') }}"
                            class="font-medium text-[#D97757] hover:text-orange-600 transition-colors">
                            Masuk di sini
                        </a>
                    </p>
                </div>

                @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md" role="alert">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register.post') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="flex space-x-4">
                        <div class="relative">
                            <label for="putra_nik" class="block text-sm font-medium text-gray-700 mb-1">NIK</label>
                            <input id="putra_nik" name="putra_nik" type="number" required
                                class="block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#D97757] focus:border-[#D97757] transition-colors"
                                placeholder="Masukkan NIK" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>

                        <div class="relative">
                            <label for="putra_nama" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                            <input id="putra_nama" name="putra_nama" type="text" required
                                class="block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#D97757] focus:border-[#D97757] transition-colors"
                                placeholder="Masukkan nama">
                        </div>
                    </div>

                    <div class="flex space-x-4">
                        <div class="relative">
                            <label for="putra_username"
                                class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                            <input id="putra_username" name="putra_username" type="text" required
                                class="block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#D97757] focus:border-[#D97757] transition-colors"
                                placeholder="Username anda">
                        </div>

                        <div class="relative">
                            <label for="putra_telp" class="block text-sm font-medium text-gray-700 mb-1">Nomor
                                Telepon</label>
                            <input id="putra_telp" name="putra_telp" type="number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required
                                class="block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#D97757] focus:border-[#D97757] transition-colors"
                                placeholder="Nomor telepon anda">
                        </div>
                    </div>
                    <div class="relative">
                        <label for="putra_password" class="block text-sm font-medium text-gray-700 mb-1">Kata
                            Sandi</label>
                        <input id="putra_password" name="putra_password" type="password" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#D97757] focus:border-[#D97757] transition-colors"
                            placeholder="Buat kata sandi yang kuat">
                            <input type="checkbox" onclick="putra_showPassword()" class="mt-4" id="putra_tampil">
                        Tampilkan Kata Sandi
                    </div>
                    <script>
                        function putra_showPassword() {
                            var inputan = document.getElementById("putra_password");
                            if (inputan.type === "password") {
                                inputan.type = "text";
                            } else {
                                inputan.type = "password";
                            }
                        }
                    </script>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#D97757] hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#D97757] transition-colors transform hover:scale-105">
                            Daftar
                        </button>
                    </div>
                </form>
            </div>
            <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                <span class="text-sm text-gray-500">© 2023 Sistem Pengaduan Masyarakat</span>
            </div>
        </div>
    </div>
</body>

</html>
