{{-- PAGE 6 --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Halaman 6: Uraian Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <x-progress-bar :currentPage="6" :penomoranId="$penomoran->id" />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between mb-4 pb-2 border-b">
                        <h3 class="text-lg font-semibold text-gray-800">Uraian Barang</h3>
                        <button type="button" id="addBarangBtn"
                            class="inline-flex items-center px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition">
                            + Tambah Barang
                        </button>
                    </div>

                    <form method="POST" action="{{ route('penomoran-form.savePage6', $penomoran->id) }}" id="formUraianBarang">
                        @csrf

                        <div id="barangContainer">
                            @forelse($uraianBarangs as $index => $barang)
                                <div class="barang-item border border-gray-200 rounded-lg p-4 mb-4" data-index="{{ $index }}">
                                    <input type="hidden" name="uraian_barang_id[]" value="{{ $barang->id }}">
                                    <div class="flex items-center justify-between mb-3">
                                        <h4 class="text-sm font-semibold text-gray-700">Barang {{ $index + 1 }}</h4>
                                        <button type="button"
                                            class="removeBarangBtn text-sm text-red-600 hover:text-red-800 font-medium transition">
                                            Hapus
                                        </button>
                                    </div>

                                    <div class="mb-4">
                                        <x-input-label :value="__('Uraian Barang')" />
                                        <textarea name="uraian_barang[]" rows="2"
                                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ $barang->uraian_barang }}</textarea>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                                        <div>
                                            <x-input-label :value="__('Jumlah Kemasan')" />
                                            <x-text-input name="jumlah_kemasan[]" type="number" class="mt-1 block w-full"
                                                value="{{ $barang->jumlah_kemasan }}" />
                                        </div>
                                        <div>
                                            <x-input-label :value="__('Satuan Kemasan')" />
                                            <select name="satuan_kemasan[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                                <option value="Box" {{ $barang->satuan_kemasan == 'Box' ? 'selected' : '' }}>Box</option>
                                                <option value="Kardus" {{ $barang->satuan_kemasan == 'Kardus' ? 'selected' : '' }}>Kardus</option>
                                                <option value="Koli" {{ $barang->satuan_kemasan == 'Koli' ? 'selected' : '' }}>Koli</option>
                                                <option value="Paket" {{ $barang->satuan_kemasan == 'Paket' ? 'selected' : '' }}>Paket</option>
                                                <option value="Karung" {{ $barang->satuan_kemasan == 'Karung' ? 'selected' : '' }}>Karung</option>
                                                <option value="Kantong" {{ $barang->satuan_kemasan == 'Kantong' ? 'selected' : '' }}>Kantong</option>
                                                <option value="Palet" {{ $barang->satuan_kemasan == 'Palet' ? 'selected' : '' }}>Palet</option>
                                                <option value="Peti Kayu" {{ $barang->satuan_kemasan == 'Peti Kayu' ? 'selected' : '' }}>Peti Kayu</option>
                                                <option value="Lainnya" {{ $barang->satuan_kemasan == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                            </select>
                                        </div>
                                        <div>
                                            <x-input-label :value="__('Berat')" />
                                            <x-text-input name="berat[]" type="number" step="any" class="mt-1 block w-full"
                                                value="{{ $barang->berat }}" />
                                        </div>
                                        <div>
                                            <x-input-label :value="__('Satuan Berat')" />
                                            <select name="satuan[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                                <option value="Kilogram" {{ $barang->satuan == 'Kilogram' ? 'selected' : '' }}>Kilogram</option>
                                                <option value="Ton" {{ $barang->satuan == 'Ton' ? 'selected' : '' }}>Ton</option>
                                                <option value="Gram" {{ $barang->satuan == 'Gram' ? 'selected' : '' }}>Gram</option>
                                                <option value="Pon" {{ $barang->satuan == 'Pon' ? 'selected' : '' }}>Pon</option>
                                                <option value="Lainnya" {{ $barang->satuan == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <x-input-label :value="__('Nilai CIF')" />
                                            <x-text-input name="nilai_cif[]" type="number" step="any" class="mt-1 block w-full"
                                                value="{{ $barang->nilai_cif }}" />
                                        </div>
                                        <div>
                                            <x-input-label :value="__('Kota PIBK')" />
                                            <x-text-input name="kota_pibk[]" type="text" class="mt-1 block w-full"
                                                value="{{ $barang->kota_pibk }}" />
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <x-input-label :value="__('Pemberitahu')" />
                                            <x-text-input name="pemberitahu[]" type="text" class="mt-1 block w-full"
                                                value="{{ $barang->pemberitahu }}" />
                                        </div>
                                        <div>
                                            <x-input-label :value="__('NP')" />
                                            <x-text-input name="np[]" type="text" class="mt-1 block w-full"
                                                value="{{ $barang->np }}" />
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <x-input-label :value="__('Pos Tarif/HS')" />
                                            <x-text-input name="pos_tarif_hs[]" type="text" class="mt-1 block w-full"
                                                value="{{ $barang->pos_tarif_hs }}" />
                                        </div>
                                        <div>
                                            <x-input-label :value="__('NDPBM')" />
                                            <x-text-input name="ndpbm[]" type="number" step="any" class="mt-1 block w-full"
                                                value="{{ $barang->ndpbm }}" />
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <x-input-label :value="__('Dalam Rupiah')" />
                                            <x-text-input name="dalam_rupiah[]" type="number" step="any" class="mt-1 block w-full"
                                                value="{{ $barang->dalam_rupiah }}" />
                                        </div>
                                        <div>
                                            <x-input-label :value="__('BM')" />
                                            <x-text-input name="bm[]" type="number" step="any" class="mt-1 block w-full"
                                                value="{{ $barang->bm }}" />
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <x-input-label :value="__('Cukai')" />
                                            <x-text-input name="cukai[]" type="number" step="any" class="mt-1 block w-full"
                                                value="{{ $barang->cukai }}" />
                                        </div>
                                        <div>
                                            <x-input-label :value="__('PPN')" />
                                            <x-text-input name="ppn[]" type="number" step="any" class="mt-1 block w-full"
                                                value="{{ $barang->ppn }}" />
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <x-input-label :value="__('PPNBM')" />
                                            <x-text-input name="ppnbm[]" type="number" step="any" class="mt-1 block w-full"
                                                value="{{ $barang->ppnbm }}" />
                                        </div>
                                        <div>
                                            <x-input-label :value="__('PPH')" />
                                            <x-text-input name="pph[]" type="number" step="any" class="mt-1 block w-full"
                                                value="{{ $barang->pph }}" />
                                        </div>
                                    </div>

                                    <div>
                                        <x-input-label :value="__('Total')" />
                                        <x-text-input name="total[]" type="number" step="any" class="mt-1 block w-full"
                                            value="{{ $barang->total }}" />
                                    </div>

                                    <div class="mt-4">
                                        <button type="button" class="saveBarangBtn inline-flex items-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md transition">
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <div class="barang-item border border-gray-200 rounded-lg p-4 mb-4" data-index="0">
                                    <input type="hidden" name="uraian_barang_id[]" value="">
                                    <div class="flex items-center justify-between mb-3">
                                        <h4 class="text-sm font-semibold text-gray-700">Barang 1</h4>
                                        <button type="button"
                                            class="removeBarangBtn text-sm text-red-600 hover:text-red-800 font-medium transition">
                                            Hapus
                                        </button>
                                    </div>

                                    <div class="mb-4">
                                        <x-input-label :value="__('Uraian Barang')" />
                                        <textarea name="uraian_barang[]" rows="2"
                                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                                        <div>
                                            <x-input-label :value="__('Jumlah Kemasan')" />
                                            <x-text-input name="jumlah_kemasan[]" type="number" class="mt-1 block w-full" />
                                        </div>
                                        <div>
                                            <x-input-label :value="__('Satuan Kemasan')" />
                                            <select name="satuan_kemasan[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                                <option value="">Pilih...</option>
                                                <option value="Box">Box</option>
                                                <option value="Kardus">Kardus</option>
                                                <option value="Koli">Koli</option>
                                                <option value="Paket">Paket</option>
                                                <option value="Karung">Karung</option>
                                                <option value="Kantong">Kantong</option>
                                                <option value="Palet">Palet</option>
                                                <option value="Peti Kayu">Peti Kayu</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        <div>
                                            <x-input-label :value="__('Berat')" />
                                            <x-text-input name="berat[]" type="number" step="any" class="mt-1 block w-full" />
                                        </div>
                                        <div>
                                            <x-input-label :value="__('Satuan Berat')" />
                                            <select name="satuan[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                                <option value="">Pilih...</option>
                                                <option value="Kilogram">Kilogram</option>
                                                <option value="Ton">Ton</option>
                                                <option value="Gram">Gram</option>
                                                <option value="Pon">Pon</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <x-input-label :value="__('Nilai CIF')" />
                                            <x-text-input name="nilai_cif[]" type="number" step="any" class="mt-1 block w-full" />
                                        </div>
                                        <div>
                                            <x-input-label :value="__('Kota PIBK')" />
                                            <x-text-input name="kota_pibk[]" type="text" class="mt-1 block w-full" />
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <x-input-label :value="__('Pemberitahu')" />
                                            <x-text-input name="pemberitahu[]" type="text" class="mt-1 block w-full" />
                                        </div>
                                        <div>
                                            <x-input-label :value="__('NP')" />
                                            <x-text-input name="np[]" type="text" class="mt-1 block w-full" />
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <x-input-label :value="__('Pos Tarif/HS')" />
                                            <x-text-input name="pos_tarif_hs[]" type="text" class="mt-1 block w-full" />
                                        </div>
                                        <div>
                                            <x-input-label :value="__('NDPBM')" />
                                            <x-text-input name="ndpbm[]" type="number" step="any" class="mt-1 block w-full" />
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <x-input-label :value="__('Dalam Rupiah')" />
                                            <x-text-input name="dalam_rupiah[]" type="number" step="any" class="mt-1 block w-full" />
                                        </div>
                                        <div>
                                            <x-input-label :value="__('BM')" />
                                            <x-text-input name="bm[]" type="number" step="any" class="mt-1 block w-full" />
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <x-input-label :value="__('Cukai')" />
                                            <x-text-input name="cukai[]" type="number" step="1" class="mt-1 block w-full" />
                                        </div>
                                        <div>
                                            <x-input-label :value="__('PPN')" />
                                            <x-text-input name="ppn[]" type="number" step="1" class="mt-1 block w-full" />
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <x-input-label :value="__('PPNBM')" />
                                            <x-text-input name="ppnbm[]" type="number" step="1" class="mt-1 block w-full" />
                                        </div>
                                        <div>
                                            <x-input-label :value="__('PPH')" />
                                            <x-text-input name="pph[]" type="number" step="1" class="mt-1 block w-full" />
                                        </div>
                                    </div>

                                    <div>
                                        <x-input-label :value="__('Total')" />
                                        <x-text-input name="total[]" type="number" step="1" class="mt-1 block w-full" />
                                    </div>

                                    <div class="mt-4">
                                        <button type="button" class="saveBarangBtn inline-flex items-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md transition">
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <a href="{{ route('penomoran-form.back', [$penomoran->id, 6]) }}" class="text-gray-600 hover:text-gray-800">← Kembali</a>
                            <x-primary-button>
                                {{ __('Simpan & Lanjut Halaman 7') }} →
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    const barangTemplate = (index) => `
        <div class="barang-item border border-gray-200 rounded-lg p-4 mb-4" data-index="${index}">
            <input type="hidden" name="uraian_barang_id[]" value="">
            <div class="flex items-center justify-between mb-3">
                <h4 class="text-sm font-semibold text-gray-700">Barang ${index + 1}</h4>
                <button type="button" class="removeBarangBtn text-sm text-red-600 hover:text-red-800 font-medium transition">Hapus</button>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700">Uraian Barang</label>
                <textarea name="uraian_barang[]" rows="2"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                <div>
                    <label class="block font-medium text-sm text-gray-700">Jumlah Kemasan</label>
                    <input type="number" name="jumlah_kemasan[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700">Satuan Kemasan</label>
                    <select name="satuan_kemasan[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <option value="">Pilih...</option>
                        <option value="Box">Box</option>
                        <option value="Kardus">Kardus</option>
                        <option value="Buah">Buah</option>
                        <option value="Paket">Paket</option>
                        <option value="Karung">Karung</option>
                        <option value="Kantong">Kantong</option>
                        <option value="Palet">Palet</option>
                        <option value="Peti Kayu">Peti Kayu</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700">Berat</label>
                    <input type="number" step="any" name="berat[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700">Satuan Berat</label>
                    <select name="satuan[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <option value="">Pilih...</option>
                        <option value="Kilogram">Kilogram</option>
                        <option value="Ton">Ton</option>
                        <option value="Gram">Gram</option>
                        <option value="Pon">Pon</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-medium text-sm text-gray-700">Nilai CIF</label>
                    <input type="number" step="any" name="nilai_cif[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700">Kota PIBK</label>
                    <input type="text" name="kota_pibk[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-medium text-sm text-gray-700">Pemberitahu</label>
                    <input type="text" name="pemberitahu[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700">NP</label>
                    <input type="text" name="np[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-medium text-sm text-gray-700">Pos Tarif/HS</label>
                    <input type="text" name="pos_tarif_hs[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700">NDPBM</label>
                    <input type="number" step="any" name="ndpbm[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-medium text-sm text-gray-700">Dalam Rupiah</label>
                    <input type="number" step="any" name="dalam_rupiah[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700">BM</label>
                    <input type="number" step="any" name="bm[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-medium text-sm text-gray-700">Cukai</label>
                                    <input type="number" step="any" name="cukai[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                </div>
                                <div>
                                    <label class="block font-medium text-sm text-gray-700">PPN</label>
                                    <input type="number" step="any" name="ppn[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block font-medium text-sm text-gray-700">PPNBM</label>
                                    <input type="number" step="any" name="ppnbm[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                </div>
                                <div>
                                    <label class="block font-medium text-sm text-gray-700">PPH</label>
                                    <input type="number" step="any" name="pph[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                </div>
                            </div>

                            <div>
                                <label class="block font-medium text-sm text-gray-700">Total</label>
                                <input type="number" step="any" name="total[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <button type="button" class="saveBarangBtn inline-flex items-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md transition">
                    Simpan
                </button>
            </div>
        </div>
    `;

    const savePage6ItemRoute = "{{ route('penomoran-form.savePage6Item', $penomoran->id) }}";
    const csrfToken = document.querySelector('#formUraianBarang input[name="_token"]').value;

    document.getElementById('addBarangBtn').addEventListener('click', function () {
        const container = document.getElementById('barangContainer');
        const newIndex = container.querySelectorAll('.barang-item').length;
        container.insertAdjacentHTML('beforeend', barangTemplate(newIndex));
        attachRemoveListeners();
        attachSaveListeners();
    });

    function collectRowData(row) {
        return {
            uraian_barang_id: row.querySelector('input[name="uraian_barang_id[]"]').value,
            uraian_barang: row.querySelector('textarea[name="uraian_barang[]"]').value,
            jumlah_kemasan: row.querySelector('input[name="jumlah_kemasan[]"]').value,
            satuan_kemasan: row.querySelector('select[name="satuan_kemasan[]"]').value,
            berat: row.querySelector('input[name="berat[]"]').value,
            satuan: row.querySelector('select[name="satuan[]"]').value,
            nilai_cif: row.querySelector('input[name="nilai_cif[]"]').value,
            kota_pibk: row.querySelector('input[name="kota_pibk[]"]').value,
            pemberitahu: row.querySelector('input[name="pemberitahu[]"]').value,
            np: row.querySelector('input[name="np[]"]').value,
            pos_tarif_hs: row.querySelector('input[name="pos_tarif_hs[]"]').value,
            ndpbm: row.querySelector('input[name="ndpbm[]"]').value,
            dalam_rupiah: row.querySelector('input[name="dalam_rupiah[]"]').value,
            bm: row.querySelector('input[name="bm[]"]').value,
            cukai: row.querySelector('input[name="cukai[]"]').value,
            ppn: row.querySelector('input[name="ppn[]"]').value,
            ppnbm: row.querySelector('input[name="ppnbm[]"]').value,
            pph: row.querySelector('input[name="pph[]"]').value,
            total: row.querySelector('input[name="total[]"]').value,
        };
    }

    async function saveBarangItem(row) {
        const button = row.querySelector('.saveBarangBtn');
        const originalText = button.textContent;
        button.textContent = 'Menyimpan...';
        button.disabled = true;

        const data = collectRowData(row);
        const formData = new FormData();
        formData.append('_token', csrfToken);
        Object.entries(data).forEach(([key, value]) => {
            if (value !== undefined) {
                formData.append(key, value);
            }
        });

        try {
            const response = await fetch(savePage6ItemRoute, {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json',
                },
            });

            if (!response.ok) {
                const errorData = await response.json().catch(() => null);
                const message = errorData?.message || 'Gagal menyimpan barang';
                alert(message);
                return;
            }

            const result = await response.json();
            row.querySelector('input[name="uraian_barang_id[]"]').value = result.id;
            button.textContent = 'Tersimpan';
            setTimeout(() => {
                button.textContent = originalText;
            }, 1200);
        } catch (error) {
            alert('Terjadi kesalahan saat menyimpan barang.');
        } finally {
            button.disabled = false;
        }
    }

    function attachSaveListeners() {
        document.querySelectorAll('.saveBarangBtn').forEach(btn => {
            btn.onclick = function () {
                const row = this.closest('.barang-item');
                saveBarangItem(row);
            };
        });
    }

    function attachRemoveListeners() {
        document.querySelectorAll('.removeBarangBtn').forEach(btn => {
            btn.onclick = function () {
                const container = document.getElementById('barangContainer');
                if (container.querySelectorAll('.barang-item').length > 1) {
                    this.closest('.barang-item').remove();
                } else {
                    alert('Minimal harus ada 1 barang');
                }
            };
        });
    }

    attachRemoveListeners();
    attachSaveListeners();
</script>