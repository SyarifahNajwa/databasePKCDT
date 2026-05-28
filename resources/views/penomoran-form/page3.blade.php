<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Halaman 3: Pemberitahu & Surat Izin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Progress Bar -->
            <x-progress-bar :currentPage="3" :penomoranId="$penomoran->id" />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('penomoran-form.savePage3', $penomoran->id) }}">
                        @csrf

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Data Pemberitahu -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Data Pemberitahu</h3>

                                <div class="mb-4">
                                    <x-input-label for="identitas_pemberitahu" :value="__('Jenis Identitas Pemberitahu')" />
                                    <select id="identitas_pemberitahu" name="identitas_pemberitahu" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                        @php
                                            $identitasPemberitahuOptions = [
                                                'KTP',
                                                'SIM',
                                                'Paspor',
                                                'NPWP',
                                                'KITAS',
                                                'KITAP',
                                                'Kartu Pelajar',
                                                'NIP',
                                                'NIK',
                                                'Lainnya',
                                            ];
                                            $selectedIdentitasPemberitahu = old('identitas_pemberitahu', $pemberitahu->identitas_pemberitahu ?? '');
                                        @endphp

                                        <option value="">Pilih jenis identitas</option>
                                        @foreach($identitasPemberitahuOptions as $option)
                                            <option value="{{ $option }}" {{ $selectedIdentitasPemberitahu === $option ? 'selected' : '' }}>{{ $option }}</option>
                                        @endforeach
                                    </select>
                                    @error('identitas_pemberitahu')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="nama_pemberitahu" :value="__('Nama Pemberitahu')" />
                                    <x-text-input id="nama_pemberitahu" name="nama_pemberitahu" type="text" class="mt-1 block w-full" value="{{ old('nama_pemberitahu', $pemberitahu->nama_pemberitahu ?? '') }}" />
                                    @error('nama_pemberitahu')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-6">
                                    <x-input-label for="alamat_pemberitahu" :value="__('Alamat Pemberitahu')" />
                                    <textarea id="alamat_pemberitahu" name="alamat_pemberitahu" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" >{{ old('alamat_pemberitahu', $pemberitahu->alamat_pemberitahu ?? '') }}</textarea>
                                    @error('alamat_pemberitahu')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <!-- Surat Izin PJT/PPJK -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Surat Izin PJT/PPJK</h3>

                                <div class="mb-4">
                                    <x-input-label for="nomor_surat_izin_pjt_ppjk" :value="__('Nomor Surat Izin PJT/PPJK')" />
                                    <x-text-input id="nomor_surat_izin_pjt_ppjk" name="nomor_surat_izin_pjt_ppjk" type="text" class="mt-1 block w-full" value="{{ old('nomor_surat_izin_pjt_ppjk', $suratIzin->nomor_surat_izin_pjt_ppjk ?? '') }}" />
                                    @error('nomor_surat_izin_pjt_ppjk')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-6">
                                    <x-input-label for="tanggal_surat_izin_pjt_ppjk" :value="__('Tanggal Surat Izin PJT/PPJK')" />
                                    <x-text-input id="tanggal_surat_izin_pjt_ppjk" name="tanggal_surat_izin_pjt_ppjk" type="date" class="mt-1 block w-full" value="{{ old('tanggal_surat_izin_pjt_ppjk', $suratIzin->tanggal_surat_izin_pjt_ppjk?->format('Y-m-d') ?? '') }}" />
                                    @error('tanggal_surat_izin_pjt_ppjk')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <a href="{{ route('penomoran-form.back', [$penomoran->id, 3]) }}" class="text-gray-600 hover:text-gray-800">← Kembali</a>
                            <x-primary-button>
                                {{ __('Lanjut ke Halaman 4') }} →
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
