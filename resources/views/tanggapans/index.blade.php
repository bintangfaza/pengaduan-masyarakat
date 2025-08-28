<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Daftar Tanggapan untuk: {{ $pengaduan->judul }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <h3 class="font-bold mb-4">Tambah Tanggapan</h3>
                <form action="{{ route('tanggapans.store', $pengaduan) }}" method="POST" class="mb-6">
                    @csrf
                    <textarea name="isi_tanggapan" rows="3" class="w-full border rounded p-2"></textarea>
                    <x-primary-button class="mt-2">Kirim</x-primary-button>
                </form>

                <h3 class="font-bold mb-4">Daftar Tanggapan</h3>
                @forelse ($tanggapans as $tanggapan)
                    <div class="border-b py-2">
                        <p>{{ $tanggapan->isi_tanggapan }}</p>
                        <p class="text-sm text-gray-500">oleh {{ $tanggapan->user->name }} - {{ $tanggapan->created_at->diffForHumans() }}</p>
                        <form action="{{ route('tanggapans.destroy', [$pengaduan, $tanggapan]) }}" method="POST" class="mt-2">
                            @csrf @method('DELETE')
                            <x-danger-button>Hapus</x-danger-button>
                        </form>
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada tanggapan.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
