<!-- PAGE 8 -->

<x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Halaman 8: Petugas') }}
            </h2>
        </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Progress Bar -->
            <x-progress-bar :currentPage="8" :penomoranId="$penomoran->id" />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('penomoran-form.savePage8', $penomoran->id) }}">
                        @csrf

                        <div class="grid grid-cols-1 lg:grid-cols-1 gap-8 ">
                            <!-- Data PFPD (Pejabat Fungsional Pemeriksa Dinas) -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Data PFPD</h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                    <div>
                                        <x-input-label for="nama_pfpd" :value="__('Nama PFPD')" />
                                        <x-text-input id="nama_pfpd" name="nama_pfpd" type="text" class="mt-1 block w-full" value="{{ old('nama_pfpd', $pfpd->nama_pfpd ?? '') }}" />
                                        @error('nama_pfpd')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <x-input-label for="nip_pfpd" :value="__('NIP PFPD')" />
                                        <x-text-input id="nip_pfpd" name="nip_pfpd" type="text" class="mt-1 block w-full" value="{{ old('nip_pfpd', $pfpd->nip_pfpd ?? '') }}" />
                                        @error('nip_pfpd')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-1 gap-8 ">
                            <!-- Data Pemeriksa -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Data Pemeriksa</h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                    <div>
                                        <x-input-label for="nama_pemeriksa" :value="__('Nama Pemeriksa')" />
                                        <x-text-input id="nama_pemeriksa" name="nama_pemeriksa" type="text" class="mt-1 block w-full" value="{{ old('nama_pemeriksa', $pemeriksa->nama_pemeriksa ?? '') }}" />
                                        @error('nama_pemeriksa')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <x-input-label for="nip_pemeriksa" :value="__('NIP Pemeriksa')" />
                                        <x-text-input id="nip_pemeriksa" name="nip_pemeriksa" type="text" class="mt-1 block w-full" value="{{ old('nip_pemeriksa', $pemeriksa->nip_pemeriksa ?? '') }}" />
                                        @error('nip_pemeriksa')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <a href="{{ route('penomoran-form.back', [$penomoran->id, 8]) }}" class="text-gray-600 hover:text-gray-800">← Kembali</a>
                            <x-primary-button>
                                {{ __('Simpan Data') }} →
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
