<x-app-layout>
    <div class="max-w-7xl mx-auto mt-3">
        <div class="flex items-center justify-between mb-3">
            <form method="GET" action="{{ route('pengaduans.index') }}" class="items-center">
                <label for="status" class="block font-medium text-gray-700">Filter Status:</label>
                <select name="status" id="status" onchange="this.form.submit()"
                    class="border rounded px-3 py-1 text-sm">
                    <option value=""> Semua </option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </form>
            @if(Auth::user()->role !== 'admin')
            <a href="{{ route('pengaduans.create') }}"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow hover:bg-indigo-700 transition">
                + Buat Pengaduan
            </a>
            @endif
        </div>

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
                        <th class="px-6 py-3 border-b">Kategori</th>
                        @if(Auth::user()->role === 'admin')
                        <th class="px-6 py-3 border-b">Status</th>
                        @endif
                        <th class="px-6 py-3 border-b">Dibuat</th>
                        <th class="px-6 py-3 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                    @forelse ($pengaduans as $index => $item)
                    <tr class="hover:bg-blue-50 transition">
                        <td class="px-6 py-4 border-b">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 border-b font-semibold">{{ $item->judul }}</td>
                        <td class="px-6 py-4 border-b">{{ Str::limit($item->isi, 80) }}</td>
                        <td class="px-6 py-4 border-b">{{ $item->kategori }}</td>
                        @if(Auth::user()->role === 'admin')
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
                        @endif
                        <td class="px-6 py-4 border-b">{{ $item->created_at->diffForHumans() }}</td>
                        <td class="px-6 py-4 border-b">
                            <div class="flex space-x-2">
                                <a href="{{ route('pengaduans.show', $item->id) }}"
                                    class="px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 text-xs">
                                    Lihat
                                </a>
                                @if(Auth::user()->role === 'admin' && $item->status != 'proses')
                                <form action="{{ route('pengaduans.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin hapus pengaduan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 text-xs">
                                        Hapus
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                            <p class="text-gray-600">Belum ada pengaduan 😔</p>
                            <a href="{{ route('pengaduans.create') }}"
                                class="mt-3 inline-block px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg hover:bg-indigo-700">
                                + Buat Pengaduan
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>