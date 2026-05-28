{{-- PAGE 6 --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Halaman 6: Uraian Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Progress Bar -->
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
                                            <x-text-input name="satuan_kemasan[]" type="text" class="mt-1 block w-full"
                                                placeholder="koli, box, etc" value="{{ $barang->satuan_kemasan }}" />
                                        </div>
                                        <div>
                                            <x-input-label :value="__('Berat')" />
                                            <x-text-input name="berat[]" type="number" step="0.01" class="mt-1 block w-full"
                                                value="{{ $barang->berat }}" />
                                        </div>
                                        <div>
                                            <x-input-label :value="__('Satuan Berat')" />
                                            <x-text-input name="satuan[]" type="text" class="mt-1 block w-full"
                                                placeholder="kg, ton, etc" value="{{ $barang->satuan }}" />
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <x-input-label :value="__('Nilai CIF')" />
                                            <x-text-input name="nilai_cif[]" type="number" step="0.01" class="mt-1 block w-full"
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
                                            <x-text-input name="ndpbm[]" type="number" step="0.01" class="mt-1 block w-full"
                                                value="{{ $barang->ndpbm }}" />
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <x-input-label :value="__('Dalam Rupiah')" />
                                            <x-text-input name="dalam_rupiah[]" type="number" step="0.01" class="mt-1 block w-full"
                                                value="{{ $barang->dalam_rupiah }}" />
                                        </div>
                                        <div>
                                            <x-input-label :value="__('BM')" />
                                            <x-text-input name="bm[]" type="number" step="0.01" class="mt-1 block w-full"
                                                value="{{ $barang->bm }}" />
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <x-input-label :value="__('Cukai')" />
                                            <x-text-input name="cukai[]" type="number" step="0.01" class="mt-1 block w-full"
                                                value="{{ $barang->cukai }}" />
                                        </div>
                                        <div>
                                            <x-input-label :value="__('PPN')" />
                                            <x-text-input name="ppn[]" type="number" step="0.01" class="mt-1 block w-full"
                                                value="{{ $barang->ppn }}" />
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <x-input-label :value="__('PPNBM')" />
                                            <x-text-input name="ppnbm[]" type="number" step="0.01" class="mt-1 block w-full"
                                                value="{{ $barang->ppnbm }}" />
                                        </div>
                                        <div>
                                            <x-input-label :value="__('PPH')" />
                                            <x-text-input name="pph[]" type="number" step="0.01" class="mt-1 block w-full"
                                                value="{{ $barang->pph }}" />
                                        </div>
                                    </div>

                                    <div>
                                        <x-input-label :value="__('Total')" />
                                        <x-text-input name="total[]" type="number" step="0.01" class="mt-1 block w-full"
                                            value="{{ $barang->total }}" />
                                    </div>
                                </div>
                            @empty
                                <div class="barang-item border border-gray-200 rounded-lg p-4 mb-4" data-index="0">
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
                                            <x-text-input name="satuan_kemasan[]" type="text" class="mt-1 block w-full"
                                                placeholder="pcs, box, etc" />
                                        </div>
                                        <div>
                                            <x-input-label :value="__('Berat')" />
                                            <x-text-input name="berat[]" type="number" step="0.01" class="mt-1 block w-full" />
                                        </div>
                                        <div>
                                            <x-input-label :value="__('Satuan Berat')" />
                                            <x-text-input name="satuan[]" type="text" class="mt-1 block w-full"
                                                placeholder="kg, ton, etc" />
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <x-input-label :value="__('Nilai CIF')" />
                                            <x-text-input name="nilai_cif[]" type="number" step="0.01" class="mt-1 block w-full" />
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
                                            <x-text-input name="ndpbm[]" type="number" step="0.01" class="mt-1 block w-full" />
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <x-input-label :value="__('Dalam Rupiah')" />
                                            <x-text-input name="dalam_rupiah[]" type="number" step="0.01" class="mt-1 block w-full" />
                                        </div>
                                        <div>
                                            <x-input-label :value="__('BM')" />
                                            <x-text-input name="bm[]" type="number" step="0.01" class="mt-1 block w-full" />
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <x-input-label :value="__('Cukai')" />
                                            <x-text-input name="cukai[]" type="number" step="0.01" class="mt-1 block w-full" />
                                        </div>
                                        <div>
                                            <x-input-label :value="__('PPN')" />
                                            <x-text-input name="ppn[]" type="number" step="0.01" class="mt-1 block w-full" />
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <x-input-label :value="__('PPNBM')" />
                                            <x-text-input name="ppnbm[]" type="number" step="0.01" class="mt-1 block w-full" />
                                        </div>
                                        <div>
                                            <x-input-label :value="__('PPH')" />
                                            <x-text-input name="pph[]" type="number" step="0.01" class="mt-1 block w-full" />
                                        </div>
                                    </div>

                                    <div>
                                        <x-input-label :value="__('Total')" />
                                        <x-text-input name="total[]" type="number" step="0.01" class="mt-1 block w-full" />
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
                    <input type="text" name="satuan_kemasan[]" placeholder="pcs, box, etc" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700">Berat</label>
                    <input type="number" step="0.01" name="berat[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700">Satuan Berat</label>
                    <input type="text" name="satuan[]" placeholder="kg, ton, etc" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-medium text-sm text-gray-700">Nilai CIF</label>
                    <input type="number" step="0.01" name="nilai_cif[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
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
                    <input type="number" step="0.01" name="ndpbm[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-medium text-sm text-gray-700">Dalam Rupiah</label>
                    <input type="number" step="0.01" name="dalam_rupiah[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700">BM</label>
                    <input type="number" step="0.01" name="bm[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-medium text-sm text-gray-700">Cukai</label>
                    <input type="number" step="0.01" name="cukai[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700">PPN</label>
                    <input type="number" step="0.01" name="ppn[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-medium text-sm text-gray-700">PPNBM</label>
                    <input type="number" step="0.01" name="ppnbm[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700">PPH</label>
                    <input type="number" step="0.01" name="pph[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>
            </div>

            <div>
                <label class="block font-medium text-sm text-gray-700">Total</label>
                <input type="number" step="0.01" name="total[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            </div>
        </div>
    `;

    document.getElementById('addBarangBtn').addEventListener('click', function () {
        const container = document.getElementById('barangContainer');
        const newIndex = container.querySelectorAll('.barang-item').length;
        container.insertAdjacentHTML('beforeend', barangTemplate(newIndex));
        attachRemoveListeners();
    });

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
</script>