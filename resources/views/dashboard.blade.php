<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Selamat Datang') }} {{ Auth::user()->name }}!
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Selamat Datang di Layanan Pemberitahuan Impor Barang Khusus (PIBK)</h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="p-6 bg-blue-50 border border-blue-200 rounded-lg shadow-sm">
                            <p class="text-sm text-gray-600 uppercase tracking-wide">Total Surat Dibuat</p>
                            <p class="mt-3 text-3xl font-semibold text-blue-800">{{ $totalPenomorans }}</p>
                        </div>
                        <div class="p-6 bg-indigo-50 border border-indigo-200 rounded-lg shadow-sm md:col-span-2">
                            <p class="text-sm text-gray-600 uppercase tracking-wide">Ayo Buat Surat Baru</p>
                            <h3 class="mt-3 text-2xl font-semibold text-gray-800">Mulai pengisian data surat sekarang</h3>
                            <p class="mt-2 text-gray-600">Klik tombol di bawah untuk memulai input data surat PIBK dan kelola dokumen Anda dengan cepat.</p>
                            <div class="mt-5 flex flex-col sm:flex-row gap-3">
                                <a href="{{ route('penomoran-form.create') }}" class="inline-flex items-center justify-center px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-md transition">Buat Surat Baru</a>
                                <a href="{{ route('penomoran-form.list') }}" class="inline-flex items-center justify-center px-5 py-3 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-md transition">Lihat Daftar Surat</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>