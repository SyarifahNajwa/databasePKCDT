<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Halaman 4: Pengangkutan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Progress Bar -->
            <x-progress-bar :currentPage="4" :penomoranId="$penomoran->id" />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('penomoran-form.savePage4', $penomoran->id) }}">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="cara_pengangkutan" :value="__('Cara Pengangkutan')" />
                            <select id="cara_pengangkutan" name="cara_pengangkutan" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Cara Pengangkutan --</option>
                                <option value="udara" {{ old('cara_pengangkutan', $pengangkutan->cara_pengangkutan ?? '') == 'udara' ? 'selected' : '' }}>Udara</option>
                                <option value="laut" {{ old('cara_pengangkutan', $pengangkutan->cara_pengangkutan ?? '') == 'laut' ? 'selected' : '' }}>Laut</option>
                                <option value="darat" {{ old('cara_pengangkutan', $pengangkutan->cara_pengangkutan ?? '') == 'darat' ? 'selected' : '' }}>Darat</option>
                            </select>
                            @error('cara_pengangkutan')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label for="nama_sarkut" :value="__('Nama Sarana Angkut')" />
                            <x-text-input id="nama_sarkut" name="nama_sarkut" type="text" class="mt-1 block w-full" value="{{ old('nama_sarkut', $pengangkutan->nama_sarkut ?? '') }}" />
                            @error('nama_sarkut')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label for="no_flight" :value="__('No. Voy/Flight')" />
                            <x-text-input id="no_flight" name="no_flight" type="text" class="mt-1 block w-full" value="{{ old('no_flight', $pengangkutan->no_flight ?? '') }}" />
                            @error('no_flight')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label for="pelabuhan_muat" :value="__('Pelabuhan Muat')" />
                            <x-text-input id="pelabuhan_muat" name="pelabuhan_muat" type="text" class="mt-1 block w-full" value="{{ old('pelabuhan_muat', $pengangkutan->pelabuhan_muat ?? '') }}" />
                            @error('pelabuhan_muat')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-6">
                            <x-input-label for="pelabuhan_bongkar" :value="__('Pelabuhan Bongkar')" />
                            <x-text-input id="pelabuhan_bongkar" name="pelabuhan_bongkar" type="text" class="mt-1 block w-full" value="{{ old('pelabuhan_bongkar', $pengangkutan->pelabuhan_bongkar ?? '') }}" />
                            @error('pelabuhan_bongkar')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <a href="{{ route('penomoran-form.back', [$penomoran->id, 4]) }}" class="text-gray-600 hover:text-gray-800">← Kembali</a>
                            <x-primary-button>
                                {{ __('Simpan & Lanjut Halaman 5') }} →
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
