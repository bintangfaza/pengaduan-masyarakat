<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang | Pengaduan Masyarakat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body class="antialiased bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow-md fixed w-full z-10">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="text-xl font-bold text-indigo-600 flex items-center">
                <img src="{{ asset('storage/logo.png') }}" alt="Logo" class="h-10 w-auto me-2">
            </a>

            <div class="space-x-6 hidden md:flex">
                <a href="#tentang" class="hover:text-indigo-600">Tentang</a>
                <a href="#fitur" class="hover:text-indigo-600">Fitur</a>
            </div>

            <div>
                @guest
                <!-- Belum login -->
                <a href="{{ route('login') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg">Login</a>
                <a href="{{ route('register') }}"
                    class="ml-2 px-4 py-2 border border-indigo-600 text-indigo-600 rounded-lg hover:bg-indigo-50">
                    Daftar
                </a>
                @else
    
                @if(Auth::user()->role == 'admin')
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg">
                    Dashboard Admin
                </a>
                @else
                <a href="{{ route('warga.dashboard') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                    Dashboard Saya
                </a>
                @endif
                @endguest
            </div>
        </div>
    </nav>


    <!-- Hero -->
    <section class="pt-32 pb-20 bg-gradient-to-r from-indigo-600 to-blue-500 text-white">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

            <!-- Teks -->
            <div class="text-center md:text-left" data-aos="fade-right" data-aos-duration="1000">
                <h2 class="text-4xl font-extrabold mb-4">Sampaikan Keluhanmu dengan Mudah</h2>
                <p class="mb-6 text-lg">
                    Website ini hadir untuk membantu masyarakat melaporkan permasalahan di lingkungan sekitar
                    tanpa harus malu atau bingung. Semua laporan akan diteruskan agar pemerintah lebih tanggap.
                </p>
                <a href="{{ route('register') }}"
                    class="px-6 py-3 bg-white text-indigo-600 rounded-lg font-semibold shadow-md hover:bg-gray-100 transition">
                    Daftar Sekarang
                </a>
            </div>

            <!-- Gambar -->
            <div class="flex justify-center md:justify-end" data-aos="fade-left" data-aos-duration="1000">
                <img src="{{ asset('storage/work.png') }}" alt="Ilustrasi Pengaduan"
                    class="w-80 md:w-96 drop-shadow-lg rounded-xl">
            </div>
        </div>
    </section>


    <!-- Tentang -->
    <section id="tentang" class="bg-gray-50 py-20">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

            <!-- Gambar -->
            <div class="flex justify-center" data-aos="fade-right" data-aos-duration="1000">
                <img src="{{ asset('storage/why.png') }}"
                    alt="Ilustrasi Pengaduan"
                    class="w-72 md:w-96 drop-shadow-xl rounded-xl">
            </div>

            <!-- Teks -->
            <div class="text-center md:text-left" data-aos="fade-left" data-aos-duration="1000">
                <h2 class="text-3xl md:text-4xl font-bold mb-6 text-indigo-700">Kenapa Aplikasi Ini Dibuat?</h2>
                <p class="text-gray-600 leading-relaxed text-lg">
                    Banyak masyarakat yang ingin menyampaikan keluhan, tetapi masih merasa
                    <span class="font-semibold text-indigo-600">malu</span>,
                    <span class="font-semibold text-indigo-600">bingung</span> harus melapor ke mana,
                    atau khawatir laporannya tidak ditanggapi.
                    <br><br>
                    Aplikasi ini hadir sebagai <span class="font-semibold">wadah resmi</span> agar suara masyarakat lebih terdengar
                    dan pemerintah dapat mengetahui kondisi di lapangan secara langsung.
                    Dengan adanya sistem ini, pengaduan lebih
                    <span class="font-semibold text-indigo-600">terstruktur, transparan, dan cepat ditindaklanjuti.</span>
                </p>
            </div>

        </div>
    </section>

    <!-- Fitur -->
    <section id="fitur" class="bg-gray-100 py-16">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-2xl font-bold mb-10">Fitur Utama</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h3 class="text-xl font-bold text-indigo-600 mb-3">📢 Laporan Mudah</h3>
                    <p class="text-gray-600">Masyarakat bisa langsung mengirim laporan hanya dengan beberapa langkah sederhana.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h3 class="text-xl font-bold text-green-600 mb-3">✅ Transparansi</h3>
                    <p class="text-gray-600">Setiap laporan bisa dipantau statusnya: Pending, Diproses, atau Selesai.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h3 class="text-xl font-bold text-blue-600 mb-3">📊 Statistik</h3>
                    <p class="text-gray-600">Data aduan yang sudah selesai, diproses, atau menunggu bisa dilihat secara real-time.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6 text-center">
        <p>&copy; {{ date('Y') }} Pengaduan Masyarakat | Dibuat dengan ❤️ Laravel + Tailwind</p>
    </footer>
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>