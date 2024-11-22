<!-- resources/views/components/detail-modal.blade.php -->
<div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-4/5 lg:w-3/5 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-xl font-bold">Detail Laporan</h3>
            <button onclick="closeModal()" class="text-black close-modal">&times;</button>
        </div>
        <div class="mt-2">
            <div class="flex flex-col md:flex-row">
                <!-- Left side - Photo -->
                <div class="w-full md:w-1/3 pr-4">
                    <img src="{{ $photo }}" alt="User Photo" class="w-full h-auto rounded-lg">
                </div>
                <!-- Right side - Details -->
                <div class="w-full md:w-2/3">
                    <p><strong>NIK:</strong> {{ $nik }}</p>
                    <p><strong>Username:</strong> {{ $username }}</p>
                    <p><strong>Tanggal:</strong> {{ $date }}</p>
                    <p><strong>Isi Laporan:</strong></p>
                    <p class="mt-2">{{ $content }}</p>
                </div>
            </div>
            <!-- Feedback Section -->
            <div class="mt-4">
                <label for="feedback" class="block text-sm font-medium text-gray-700">Tanggapan:</label>
                <textarea id="feedback" name="feedback" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            </div>
            <!-- Status Dropdown -->
            <div class="mt-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status:</label>
                <select id="status" name="status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="process">Proses</option>
                    <option value="completed">Selesai</option>
                </select>
            </div>
            <!-- Submit Button -->
            <div class="mt-4">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Simpan Tanggapan
                </button>
            </div>
        </div>
    </div>
</div>
