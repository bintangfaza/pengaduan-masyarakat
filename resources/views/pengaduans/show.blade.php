<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pengaduan') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">

                {{-- Header Judul & Info --}}
                <div class="mb-6 border-b pb-4">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $pengaduan->judul }}</h1>
                    <p class="text-sm text-gray-500">
                        Diajukan oleh
                        <span class="font-medium text-gray-700">{{ $pengaduan->user->name }}</span> •
                        {{ $pengaduan->created_at->format('d M Y H:i') }}
                    </p>
                    {{-- Status --}}
                    <div class="mb-6">
                        @if($pengaduan->status == 'pending')
                        <span class="px-4 py-1.5 text-xs rounded-full bg-yellow-200 text-yellow-800 font-semibold shadow-sm">Pending</span>
                        @elseif($pengaduan->status == 'proses')
                        <span class="px-4 py-1.5 text-xs rounded-full bg-blue-200 text-blue-800 font-semibold shadow-sm">Diproses</span>
                        @elseif($pengaduan->status == 'selesai')
                        <span class="px-4 py-1.5 text-xs rounded-full bg-green-200 text-green-800 font-semibold shadow-sm">Selesai</span>
                        @endif
                    </div>

                </div>

                {{-- Isi Pengaduan --}}
                <div class="mb-8">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800">Deskripsi</h3>
                    <div class="p-4 bg-gray-50 rounded-lg border leading-relaxed text-gray-700">
                        {{ $pengaduan->isi }}
                    </div>
                </div>

                {{-- Foto --}}
                @if ($pengaduan->foto)
                <div class="mb-8">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800">Lampiran Foto</h3>
                    <img src="{{ asset('storage/' . $pengaduan->foto) }}"
                        alt="Foto Pengaduan"
                        class="rounded-xl shadow-md border w-full max-w-xl mx-auto">
                </div>
                @endif

                {{-- Form tanggapan khusus admin --}}
                @if(auth()->user()->isAdmin())
                <div class="mb-10">
                    <h3 class="text-lg font-semibold mb-3 text-gray-800">Beri Tanggapan</h3>
                    <form action="{{ route('tanggapans.store', $pengaduan->id) }}" method="POST" class="space-y-4">
                        @csrf
                        <textarea name="isi_tanggapan" class="w-full p-3 border rounded-lg focus:ring focus:ring-indigo-300" rows="3" placeholder="Tulis tanggapan..."></textarea>
                        <select name="status" class="p-2 border rounded-lg">
                            <option value="pending" {{ $pengaduan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="proses" {{ $pengaduan->status == 'proses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg shadow hover:bg-indigo-700 transition">
                            Kirim Tanggapan
                        </button>
                    </form>
                </div>
                @endif

                {{-- Daftar Tanggapan --}}
                <div class="mb-10">
                    <h3 class="text-lg font-semibold mb-3 text-gray-800">Daftar Tanggapan</h3>
                    @forelse($pengaduan->tanggapans as $tanggapan)
                    <div class="p-4 mb-3 bg-white rounded-lg border shadow-sm">
                        <p class="text-gray-700">{{ $tanggapan->isi_tanggapan }}</p>
                        <p class="text-xs text-gray-500 mt-2">
                            Oleh: <span class="font-medium">{{ $tanggapan->user->name ?? 'Admin' }}</span> • {{ $tanggapan->created_at->format('d M Y H:i') }}
                        </p>
                    </div>
                    @empty
                    <p class="text-gray-500 italic">Belum ada tanggapan.</p>
                    @endforelse
                </div>

                {{-- Tombol kembali --}}
                <div class="text-right">
                    <a href="{{ route('pengaduans.index') }}"
                        class="inline-block bg-gray-600 text-white px-5 py-2 rounded-lg shadow hover:bg-gray-700 transition">
                        Kembali
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>