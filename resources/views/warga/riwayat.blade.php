<x-app-layout>
    <div class="max-w-7xl mx-auto">
        @if (session('success'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 3000)"
            class="mb-4 p-4 rounded-lg bg-green-100 text-green-700 shadow-sm">
            {{ session('success') }}    
        </div>
        @endif
        @if (session('error'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 3000)"
            class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded-md shadow">
            {{ session('error') }}
        </div>
        @endif

        {{-- Tabel pengaduan --}}
        <div class="overflow-x-auto bg-white shadow rounded-xl">
            <table class="w-full border-collapse text-left">
                <thead>
                    <tr class="bg-gradient-to-r from-indigo-600 to-blue-500 text-white text-center text-sm">
                        <th class="px-6 py-3 border-b">No</th>
                        <th class="px-6 py-3 border-b">Judul</th>
                        <th class="px-6 py-3 border-b">Isi</th>
                        <th class="px-6 py-3 border-b">Status</th>
                        <th class="px-6 py-3 border-b">Dibuat</th>
                        <th class="px-6 py-3 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-600">
                    @forelse ($riwayat as $index => $item)
                    <tr class="hover:bg-blue-50 transition">
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
                        <td class="px-6 py-4 border-b">
                            <div class="flex space-x-2">
                                <a href="{{ route('pengaduans.show', $item->id) }}"
                                    class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition">
                                    Lihat
                                </a>
                                <a href="{{ route('pengaduans.edit', $item->id) }}"
                                    class="px-3 py-1 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 text-xs">
                                    Edit
                                </a>
                                <form action="{{ route('pengaduans.destroyRiwayat', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin hapus pengaduan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 text-xs">
                                        Hapus
                                    </button>
                                </form>
                            </div>

                        </td>
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