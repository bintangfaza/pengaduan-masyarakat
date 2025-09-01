<x-app-layout>
   
    <div class="py-10 mt-3">
         <div class="flex items-center justify-between mb-6 px-6">
            <h2 class="text-2xl font-bold text-gray-800">Manajemen User</h2>
        </div>
        <div class="w-full mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Notifikasi --}}
            @if (session('success'))
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="mb-4 p-4 rounded-lg bg-green-100 text-green-700 border border-green-200 shadow">
                     {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="mb-4 p-4 rounded-lg bg-red-100 text-red-700 border border-red-200 shadow">
                     {{ session('error') }}
                </div>
            @endif

            {{-- Card Tabel --}}
            <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="bg-gradient-to-r from-indigo-600 to-blue-500 text-white text-sm">
                            <tr>
                                <th class="px-6 py-3 font-semibold">Nama</th>
                                <th class="px-6 py-3 font-semibold">Email</th>
                                <th class="px-6 py-3 font-semibold">Alamat</th>
                                <th class="px-6 py-3 font-semibold">No HP</th>
                                <th class="px-6 py-3 text-center font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($users as $user)
                                <tr class="hover:bg-blue-50 transition">
                                    <td class="px-6 py-4 font-medium text-gray-800">{{ $user->name }}</td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4">{{ $user->address ?? '-' }}</td>
                                    <td class="px-6 py-4">{{ $user->phone ?? '-' }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus user ini?')"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-4 py-2 rounded-lg bg-red-500 hover:bg-red-600 text-white font-medium text-xs shadow-md transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
