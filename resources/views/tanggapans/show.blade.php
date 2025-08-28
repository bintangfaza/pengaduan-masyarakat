<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detail Tanggapan
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <p class="mb-4">{{ $tanggapan->isi_tanggapan }}</p>
                <p class="text-sm text-gray-500">Oleh: {{ $tanggapan->user->name }}</p>
                <p class="text-sm text-gray-500">Dibuat: {{ $tanggapan->created_at }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
