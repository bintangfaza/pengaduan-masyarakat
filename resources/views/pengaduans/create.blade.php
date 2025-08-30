<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Pengaduan Baru') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Pesan sukses --}}
                    @if(session('success'))
                    <div class="mb-4 p-4 text-green-700 bg-green-100 rounded-lg">
                        {{ session('success') }}
                    </div>
                    @endif

                    {{-- Form tambah pengaduan --}}
                    <form method="POST" action="{{ route('pengaduans.store') }}" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <x-input-label for="judul" :value="__('Judul')" />
                            <x-text-input id="judul" name="judul" type="text" class="mt-1 block w-full" required />
                            <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="isi" :value="__('Isi')" />
                            <textarea id="isi" name="isi" rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required></textarea>
                            <x-input-error :messages="$errors->get('isi')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="foto" :value="__('Foto')" />
                            <input type="file" id="foto" name="foto"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                   file:rounded-full file:border-0 file:text-sm file:font-semibold
                   file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                            <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="kategori" :value="__('Kategori')" />
                            <select id="kategori" name="kategori"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">-- Pilih Kategori --</option>
                                <option value="infrastruktur">Infrastruktur</option>
                                <option value="keamanan">Keamanan</option>
                                <option value="kesehatan">Kesehatan</option>
                                <option value="Bencana">Bencana Alam</option>
                                <option value="Jalan">Jalan</option>
                                <option value="lainnya">Lainya</option>
                            </select>
                            <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                        </div>

                        <div>
                            <x-primary-button>{{ __('Kirim Pengaduan') }}</x-primary-button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>