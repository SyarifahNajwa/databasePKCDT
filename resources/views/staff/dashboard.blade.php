<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Selamat Datang') }} {{ auth()->user()->name }}!
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Halo, {{ auth()->user()->name }}!</h3>
                            <p class="mt-2 text-sm text-gray-600">Gunakan menu di bawah untuk melihat surat masuk dan melanjutkan proses pengajuan.</p>
                        </div>

                        <div class="rounded-xl border border-gray-200 bg-gray-50 p-6">
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-base font-semibold text-gray-900">Lihat Surat Masuk</p>
                                    <p class="mt-1 text-sm text-gray-600">Kelola pengajuan masuk dari pengguna jasa dan lihat surat yang sudah selesai.</p>
                                </div>
                                <div class="flex flex-col gap-3 sm:flex-row">
                                    <a href="{{ route('staff.pengajuan.index') }}" class="inline-flex items-center justify-center rounded-md bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                                        Lihat Surat Masuk
                                    </a>
                                    <a href="{{ route('staff.pengajuan.drafts') }}" class="inline-flex items-center justify-center rounded-md bg-green-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-green-700">
                                        Draft Surat
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
