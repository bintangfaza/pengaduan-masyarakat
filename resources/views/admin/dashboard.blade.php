<x-app-layout>
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-center py-14">
        <h2 class="text-3xl font-bold">Dashboard Admin</h2>
        <p class="mt-2 text-lg">Pantau pengaduan, kelola pengguna, dan kontrol sistem aplikasi</p>
    </section>


    <!-- Statistik -->
    <section class="max-w-6xl mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-4 gap-6 text-center">
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition" data-aos="fade-up">
            <h3 class="text-4xl font-bold text-indigo-600">{{ $totalPengaduan }}</h3>
            <p class="text-gray-600 mt-2">Total Pengaduan</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition" data-aos="fade-up">
            <h3 class="text-4xl font-bold text-indigo-600">{{ $totalUsers }}</h3>
            <p class="text-gray-600 mt-2">Total User</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-4xl font-bold text-green-600">{{ $selesaiAduan }}</h3>
            <p class="text-gray-600 mt-2">Selesai</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition" data-aos="fade-up" data-aos-delay="200">
            <h3 class="text-4xl font-bold text-yellow-500">{{ $prosesAduan }}</h3>
            <p class="text-gray-600 mt-2">Sedang Diproses</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition" data-aos="fade-up" data-aos-delay="300">
            <h3 class="text-4xl font-bold text-red-500">{{ $pendingAduan }}</h3>
            <p class="text-gray-600 mt-2">Belum Ditanggapi</p>
        </div>
    </section>

</x-app-layout>