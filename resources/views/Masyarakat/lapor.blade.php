@extends('layouts.pengaduanLayout')
@section('content')
    @if (session('success'))
        <div id="success-alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @vite('resources/css/app.css')

    <style>
        body {
            overflow-x: hidden
        }
    </style>

    <div class="min-h-screen">
        <div class="relative bg-[#D97757] text-white py-16">
            <div class="container mx-auto px-4 text-center z-10 relative">
                <h1 class="text-3xl font-bold mb-4">Layanan Aspirasi dan Pengaduan Online Rakyat</h1>
                <p class="text-lg">Sampaikan laporan Anda langsung kepada instansi pemerintah berwenang</p>
            </div>
            <div class="absolute bottom-0 left-0 right-0">
                <svg viewBox="0 0 1440 200" class="fill-white scale-125">
                    <path
                        d="M0,100L60,120C120,140,240,160,360,160C480,160,600,140,720,130C840,120,960,120,1080,130C1200,140,1320,160,1380,170L1440,180L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z">
                    </path>
                </svg>
            </div>
        </div>

        <div class="container mx-auto px-4 -mt-10">
            <div class="bg-white rounded-lg shadow-lg p-8 max-w-3xl mx-auto">
                <h2 class="text-[#D97757] font-bold text-xl mb-6">Sampaikan Laporan Anda</h2>

                <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 mb-2">dengan NIK *</label>
                            <input type="number" name="putra_nik" required readonly
                                class="w-full px-4 py-2 border rounded-md focus:ring-[#D97757] focus:border-[#D97757]"
                                value="{{ Auth::guard('masyarakat')->user()->nik}}">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Tanggal Laporan *</label>
                            <input type="date" name="putra_tanggal" required
                                class="w-full px-4 py-2 border rounded-md focus:ring-[#D97757] focus:border-[#D97757]">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Ketik Isi Laporan Anda *</label>
                            <textarea name="putra_laporan" rows="4" required
                                class="w-full px-4 py-2 border rounded-md focus:ring-[#D97757] focus:border-[#D97757]"></textarea>
                        </div>

                        <div class="flex items-center justify-between mt-8">
                            <div class="flex items-center space-x-4">
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="file" name="putra_gambar" class="hidden" id="file-upload" accept="image/*" required>
                                    <span class="px-4 py-2 border rounded-md hover:bg-gray-50">
                                        📎 Upload Lampiran
                                    </span>
                            </label>
                                <!-- Image Preview Container -->
                                <div id="image-preview-container" class="hidden">
                                    <img id="image-preview" class="h-20 w-20 object-cover rounded-md" src="" alt="Preview">
                                    <button type="button" id="remove-image" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 shadow-md hover:bg-red-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <button type="submit"
                                class="bg-[#D97757] text-white px-6 py-2 rounded-md hover:bg-[#D97757]/90">
                                LAPOR!
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // Image Preview Handler
            const fileUpload = document.getElementById('file-upload');
            const imagePreviewContainer = document.getElementById('image-preview-container');
            const imagePreview = document.getElementById('image-preview');
            const removeImageButton = document.getElementById('remove-image');

            fileUpload.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreviewContainer.classList.remove('hidden');
                        imagePreviewContainer.classList.add('relative');
                    }
                    reader.readAsDataURL(file);
                }
            });

            removeImageButton.addEventListener('click', function() {
                imagePreviewContainer.classList.add('hidden');
                fileUpload.value = '';
                imagePreview.src = '';
            });
        </script>
    @endsection
