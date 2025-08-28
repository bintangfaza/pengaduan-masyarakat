<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pengaduan') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-6">

                {{-- Judul & Info --}}
                <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $pengaduan->judul }}</h1>
                <p class="text-sm text-gray-500">Diajukan oleh <span class="font-medium">{{ $pengaduan->user->name }}</span> • {{ $pengaduan->created_at->format('d M Y H:i') }}</p>

                {{-- Status --}}
                <div class="mt-3">
                    @if($pengaduan->status == 'pending')
                    <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 font-medium">Pending</span>
                    @elseif($pengaduan->status == 'proses')
                    <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700 font-medium">Diproses</span>
                    @elseif($pengaduan->status == 'selesai')
                    <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">Selesai</span>
                    @endif
                </div>

                {{-- Isi Pengaduan --}}
                <div class="mt-6">
                    <h3 class="text-lg font-semibold mb-2">Deskripsi</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $pengaduan->isi }}</p>
                </div>

                {{-- Foto --}}
                @if ($pengaduan->foto)
                <img src="{{ asset('storage/' . $pengaduan->foto) }}"
                    alt="Foto Pengaduan"
                    class="rounded-lg shadow-md w-full max-w-lg">
                @endif

                {{-- Form tanggapan khusus admin --}}
                @if(auth()->user()->isAdmin())
                <div class="mt-8">
                    <h3 class="text-lg font-semibold mb-2">Beri Tanggapan</h3>
                    <form action="{{ route('tanggapans.store', $pengaduan->id) }}" method="POST" class="space-y-3">
                        @csrf
                        <textarea name="isi_tanggapan" class="w-full p-3 border rounded-lg focus:ring focus:ring-indigo-300" rows="3" placeholder="Tulis tanggapan..."></textarea>
                        <select name="status" class="p-2 border rounded-lg">
                            <option value="pending" {{ $pengaduan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="proses" {{ $pengaduan->status == 'proses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        <button type="submit" class="bg-indigo-600 text-white px-5 py-2 rounded-lg shadow hover:bg-indigo-700 transition">
                            Kirim
                        </button>
                    </form>
                </div>
                @endif

                {{-- Daftar tanggapan --}}
                <div class="mt-8">
                    <h3 class="text-lg font-semibold mb-3">Tanggapan</h3>
                    @forelse($pengaduan->tanggapans as $tanggapan)
                    <div class="p-4 mb-3 bg-gray-50 rounded-lg border">
                        <p class="text-gray-700">{{ $tanggapan->isi_tanggapan }}</p>
                        <p class="text-xs text-gray-500 mt-2">
                            Oleh: {{ $tanggapan->user->name ?? 'Admin' }} • {{ $tanggapan->created_at->format('d M Y H:i') }}
                        </p>
                    </div>
                    @empty
                    <p class="text-gray-500 italic">Belum ada tanggapan.</p>
                    @endforelse
                </div>

                {{-- Tombol kembali --}}
                <div class="mt-6">
                    <a href="{{ route('pengaduans.index') }}"
                        class="inline-block bg-gray-500 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-600 transition">
                        ← Kembali
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>