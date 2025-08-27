<x-app-layout>
    <div class="max-w-5xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Daftar Pengaduan Saya</h2>
            <a href="{{ route('pengaduans.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow hover:bg-indigo-700 transition">
                + Buat Pengaduan
            </a>
        </div>

        
        @if (session('success'))
            <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-700 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Tabel pengaduan --}}
        <div class="overflow-x-auto bg-white shadow rounded-xl">
            <table class="w-full border-collapse text-left">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 text-sm">
                        <th class="px-6 py-3 border-b">No</th>
                        <th class="px-6 py-3 border-b">Judul</th>
                        <th class="px-6 py-3 border-b">Isi</th>
                        <th class="px-6 py-3 border-b">Status</th>
                        <th class="px-6 py-3 border-b">Dibuat</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-600">
                    @forelse ($pengaduans as $index => $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 border-b">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 border-b font-semibold">{{ $item->judul }}</td>
                            <td class="px-6 py-4 border-b">{{ Str::limit($item->isi, 50) }}</td>
                            <td class="px-6 py-4 border-b">
                                @if ($item->status == 'pending')
                                    <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">Pending</span>
                                @elseif ($item->status == 'proses')
                                    <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700">Proses</span>
                                @elseif ($item->status == 'selesai')
                                    <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">Selesai</span>
                                @else
                                    <span class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-700">Unknown</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 border-b">{{ $item->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                Belum ada pengaduan 😔
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
