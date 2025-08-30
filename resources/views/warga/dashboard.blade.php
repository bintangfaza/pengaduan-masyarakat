<x-app-layout>
    <section class="bg-gradient-to-r from-indigo-600 to-blue-500 text-white text-center py-20">
        <h2 class="text-4xl font-extrabold mb-4">Laporkan Masalah di Sekitarmu 🚀</h2>
        <p class="mb-6 text-lg">Sampaikan pengaduanmu dengan mudah, cepat, dan transparan</p>
        <a href="{{ route('pengaduans.index') }}"
           class="px-6 py-3 bg-white text-indigo-600 rounded-lg font-semibold shadow-md hover:bg-gray-100 transition">
            Lihat Semua Pengaduan
        </a>
    </section>

    <section class="max-w-6xl mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-4 gap-6 text-center">
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition" data-aos="fade-up">
            <h3 class="text-4xl font-bold text-indigo-600">{{ $totalPengaduan }}</h3>
            <p class="text-gray-600 mt-2">Total Pengaduan</p>
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
            <p class="text-gray-600 mt-2">Baru Masuk</p>
        </div>
    </section>

    <!-- Daftar Pengaduan Terbaru -->
    <section class="max-w-6xl mx-auto px-6 py-12">
        <h2 class="text-2xl font-bold mb-6">Pengaduan Terbaru</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($pengaduanTerbaru as $p)
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition" data-aos="zoom-in">
                    @if($p->status == 'proses')
                        <span class="text-sm bg-yellow-200 text-yellow-800 px-2 py-1 rounded">Dalam Proses</span>
                    @elseif($p->status == 'selesai')
                        <span class="text-sm bg-green-200 text-green-800 px-2 py-1 rounded">Selesai</span>
                    @else
                        <span class="text-sm bg-red-200 text-red-800 px-2 py-1 rounded">Baru</span>
                    @endif
                    
                    <h3 class="font-bold text-lg mt-2">{{ $p->judul }}</h3>
                    <p class="text-gray-600 text-sm">Laporan masuk {{ $p->created_at->format('d M Y') }}</p>
                </div>
            @endforeach
        </div>
    </section>
</x-app-layout>
