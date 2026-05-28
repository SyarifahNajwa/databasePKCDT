<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Halaman 7: Pemeriksaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Progress Bar -->
            <x-progress-bar :currentPage="7" :penomoranId="$penomoran->id" />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('penomoran-form.savePage7', $penomoran->id) }}">
                        @csrf

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Waktu Pemeriksaan -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Waktu Pemeriksaan</h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <x-input-label for="hari" :value="__('Hari')" />
                                        <x-text-input id="hari" name="hari" type="text" class="mt-1 block w-full" placeholder="Misal: Senin" value="{{ old('hari', $pemeriksaan->hari ?? '') }}" />
                                        @error('hari')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <x-input-label for="tanggal" :value="__('Tanggal')" />
                                        <x-text-input id="tanggal" name="tanggal" type="date" class="mt-1 block w-full" value="{{ old('tanggal', $pemeriksaan->tanggal?->format('Y-m-d') ?? '') }}" />
                                        @error('tanggal')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <x-input-label for="jam_mulai_periksa" :value="__('Jam Mulai Periksa (WIB)')" />
                                        <x-text-input id="jam_mulai_periksa" name="jam_mulai_periksa" type="time" class="mt-1 block w-full" value="{{ old('jam_mulai_periksa', $pemeriksaan->jam_mulai_periksa?->format('H:i') ?? '') }}" />
                                        @error('jam_mulai_periksa')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <x-input-label for="jam_selesai_periksa" :value="__('Jam Selesai Periksa (WIB)')" />
                                        <x-text-input id="jam_selesai_periksa" name="jam_selesai_periksa" type="time" class="mt-1 block w-full" value="{{ old('jam_selesai_periksa', $pemeriksaan->jam_selesai_periksa?->format('H:i') ?? '') }}" />
                                        @error('jam_selesai_periksa')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                    </div>
                                </div>

                                <div class="mb-4">
                                        <x-input-label for="lokasi_pemeriksaan" :value="__('Lokasi Pemeriksaan')" />
                                        <x-text-input id="lokasi_pemeriksaan" name="lokasi_pemeriksaan" type="text" class="mt-1 block w-full" value="{{ old('lokasi_pemeriksaan', $pemeriksaan->lokasi_pemeriksaan ?? '') }}" />
                                        @error('lokasi_pemeriksaan')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                    </div>                                              
                            </div>

                            <!-- Detail dan Hasil Pemeriksaan -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Detail dan Hasil Pemeriksaan</h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <x-input-label for="nama" :value="__('Nama')" />
                                        <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" value="{{ old('nama', $pemeriksaan->nama ?? '') }}" />
                                        @error('nama')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <x-input-label for="contoh" :value="__('Contoh')" />
                                        <x-text-input id="contoh" name="contoh" type="text" class="mt-1 block w-full" value="{{ old('contoh', $pemeriksaan->contoh ?? '') }}" />
                                        @error('contoh')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <x-input-label for="foto" :value="__('Foto')" />
                                        <x-text-input id="foto" name="foto" type="text" class="mt-1 block w-full" value="{{ old('foto', $pemeriksaan->foto ?? '') }}" />
                                        @error('foto')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <x-input-label for="catatan" :value="__('Catatan')" />
                                        <x-text-input id="catatan" name="catatan" type="text" class="mt-1 block w-full" value="{{ old('catatan', $pemeriksaan->catatan ?? '') }}" />
                                        @error('catatan')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-6">

                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Detail Barang</h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <x-input-label for="kondisi_segel" :value="__('Kondisi Segel')" />
                                <x-text-input id="kondisi_segel" name="kondisi_segel" type="text" class="mt-1 block w-full" value="{{ old('kondisi_segel', $pemeriksaan->kondisi_segel ?? '') }}" />
                                @error('kondisi_segel')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <x-input-label for="jumlah_satuan_barang" :value="__('Jumlah Satuan Barang')" />
                                <x-text-input id="jumlah_satuan_barang" name="jumlah_satuan_barang" type="number" min="0" class="mt-1 block w-full" value="{{ old('jumlah_satuan_barang', $pemeriksaan->jumlah_satuan_barang ?? '') }}" />
                                @error('jumlah_satuan_barang')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <x-input-label for="satuan_barang" :value="__('Satuan Barang')" />
                                <x-text-input id="satuan_barang" name="satuan_barang" type="text" class="mt-1 block w-full" value="{{ old('satuan_barang', $pemeriksaan->satuan_barang ?? '') }}" />
                                @error('satuan_barang')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="jenis_kemasan" :value="__('Jenis Kemasan')" />
                                <x-text-input id="jenis_kemasan" name="jenis_kemasan" type="text" class="mt-1 block w-full" value="{{ old('jenis_kemasan', $pemeriksaan->jenis_kemasan ?? '') }}" placeholder="Misal: BOX"/>
                                @error('jenis_kemasan')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <x-input-label for="ukuran_kemasan" :value="__('Ukuran Kemasan')" />
                                <x-text-input id="ukuran_kemasan" name="ukuran_kemasan" type="text" class="mt-1 block w-full" value="{{ old('ukuran_kemasan', $pemeriksaan->ukuran_kemasan ?? '') }}" />
                                @error('ukuran_kemasan')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="hasil_uraian_barang" :value="__('Uraian Barang')" />
                            <textarea id="hasil_uraian_barang" name="hasil_uraian_barang" rows="3"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Deskripsikan uraian barangnya bagaimana">{{ old('hasil_uraian_barang', $pemeriksaan->hasil_uraian_barang ?? '') }}</textarea>
                            @error('hasil_uraian_barang')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label for="spesifikasi" :value="__('Spesifikasi')" />
                            <textarea id="spesifikasi" name="spesifikasi" rows="3"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('spesifikasi', $pemeriksaan->spesifikasi ?? '') }}</textarea>
                            @error('spesifikasi')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-6">
                            <x-input-label for="keterangan" :value="__('Keterangan')" />
                            <textarea id="keterangan" name="keterangan" rows="3"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('keterangan', $pemeriksaan->keterangan ?? '') }}</textarea>
                            @error('keterangan')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <a href="{{ route('penomoran-form.back', [$penomoran->id, 7]) }}" class="text-gray-600 hover:text-gray-800">← Kembali</a>
                            <x-primary-button>
                                {{ __('Simpan & Lanjut Halaman 8') }} →
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
