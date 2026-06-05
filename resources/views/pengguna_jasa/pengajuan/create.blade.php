<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Form Pengajuan PIBK</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($errors->any())
                        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">
                            <h3 class="text-sm font-semibold text-red-800">Terdapat kesalahan pada data:</h3>
                            <ul class="mt-3 list-disc list-inside text-sm text-red-700">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('pengguna-jasa.pengajuan.store') }}">
                        @csrf

                        <div class="space-y-10">
                            <section class="rounded-xl border border-gray-200 bg-gray-50 p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Pengirim</h3>
                                <div class="space-y-6">
                                    <div>
                                        <label for="nama_pengirim" class="block text-sm font-medium text-gray-700">Nama Pengirim</label>
                                        <input type="text" name="nama_pengirim" id="nama_pengirim" value="{{ old('nama_pengirim') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>

                                    <div>
                                        <label for="alamat_pengirim" class="block text-sm font-medium text-gray-700">Alamat Pengirim</label>
                                        <textarea name="alamat_pengirim" id="alamat_pengirim" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('alamat_pengirim') }}</textarea>
                                    </div>
                                </div>
                            </section>

                            <section class="rounded-xl border border-gray-200 bg-gray-50 p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Penerima</h3>
                                <div class="space-y-6">
                                    <div>
                                        <label for="jenis_identitas_penerima" class="block text-sm font-medium text-gray-700">Jenis Identitas</label>
                                        <select id="jenis_identitas_penerima" name="jenis_identitas_penerima" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            <option value="" {{ old('jenis_identitas_penerima') === '' ? 'selected' : '' }}>Pilih jenis identitas</option>
                                            <option value="KTP" {{ old('jenis_identitas_penerima') === 'KTP' ? 'selected' : '' }}>KTP</option>
                                            <option value="SIM" {{ old('jenis_identitas_penerima') === 'SIM' ? 'selected' : '' }}>SIM</option>
                                            <option value="Paspor" {{ old('jenis_identitas_penerima') === 'Paspor' ? 'selected' : '' }}>Paspor</option>
                                            <option value="NPWP" {{ old('jenis_identitas_penerima') === 'NPWP' ? 'selected' : '' }}>NPWP</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="identitas_penerima" class="block text-sm font-medium text-gray-700">Nomor Identitas</label>
                                        <input type="text" name="identitas_penerima" id="identitas_penerima" value="{{ old('identitas_penerima') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>

                                    <div>
                                        <label for="nama_penerima" class="block text-sm font-medium text-gray-700">Nama Penerima</label>
                                        <input type="text" name="nama_penerima" id="nama_penerima" value="{{ old('nama_penerima') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>

                                    <div>
                                        <label for="alamat_penerima" class="block text-sm font-medium text-gray-700">Alamat Penerima</label>
                                        <textarea name="alamat_penerima" id="alamat_penerima" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('alamat_penerima') }}</textarea>
                                    </div>
                                </div>
                            </section>

                            <section class="rounded-xl border border-gray-200 bg-gray-50 p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Pemberitahu</h3>
                                <div class="space-y-6">
                                    <div>
                                        <label for="identitas_pemberitahu" class="block text-sm font-medium text-gray-700">Jenis Identitas</label>
                                        <select id="identitas_pemberitahu" name="identitas_pemberitahu" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            <option value="" {{ old('identitas_pemberitahu') === '' ? 'selected' : '' }}>Pilih jenis identitas</option>
                                            <option value="KTP" {{ old('identitas_pemberitahu') === 'KTP' ? 'selected' : '' }}>KTP</option>
                                            <option value="SIM" {{ old('identitas_pemberitahu') === 'SIM' ? 'selected' : '' }}>SIM</option>
                                            <option value="Paspor" {{ old('identitas_pemberitahu') === 'Paspor' ? 'selected' : '' }}>Paspor</option>
                                            <option value="NPWP" {{ old('identitas_pemberitahu') === 'NPWP' ? 'selected' : '' }}>NPWP</option>
                                            <option value="KITAS" {{ old('identitas_pemberitahu') === 'KITAS' ? 'selected' : '' }}>KITAS</option>
                                            <option value="KITAP" {{ old('identitas_pemberitahu') === 'KITAP' ? 'selected' : '' }}>KITAP</option>
                                            <option value="Kartu Pelajar" {{ old('identitas_pemberitahu') === 'Kartu Pelajar' ? 'selected' : '' }}>Kartu Pelajar</option>
                                            <option value="NIP" {{ old('identitas_pemberitahu') === 'NIP' ? 'selected' : '' }}>NIP</option>
                                            <option value="NIK" {{ old('identitas_pemberitahu') === 'NIK' ? 'selected' : '' }}>NIK</option>
                                            <option value="Lainnya" {{ old('identitas_pemberitahu') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="nama_pemberitahu" class="block text-sm font-medium text-gray-700">Nama Pemberitahu</label>
                                        <input type="text" name="nama_pemberitahu" id="nama_pemberitahu" value="{{ old('nama_pemberitahu') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>

                                    <div>
                                        <label for="alamat_pemberitahu" class="block text-sm font-medium text-gray-700">Alamat Pemberitahu</label>
                                        <textarea name="alamat_pemberitahu" id="alamat_pemberitahu" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('alamat_pemberitahu') }}</textarea>
                                    </div>
                                </div>
                            </section>

                            <section class="rounded-xl border border-gray-200 bg-gray-50 p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Surat Izin PJT/PPJK</h3>
                                <div class="grid gap-6 md:grid-cols-2">
                                    <div>
                                        <label for="nomor_surat_izin_pjt_ppjk" class="block text-sm font-medium text-gray-700">Nomor Surat Izin</label>
                                        <input type="text" name="nomor_surat_izin_pjt_ppjk" id="nomor_surat_izin_pjt_ppjk" value="{{ old('nomor_surat_izin_pjt_ppjk') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>

                                    <div>
                                        <label for="tanggal_surat_izin_pjt_ppjk" class="block text-sm font-medium text-gray-700">Tanggal Surat Izin</label>
                                        <input type="date" name="tanggal_surat_izin_pjt_ppjk" id="tanggal_surat_izin_pjt_ppjk" value="{{ old('tanggal_surat_izin_pjt_ppjk') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                </div>
                            </section>

                            <section class="rounded-xl border border-gray-200 bg-gray-50 p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Data PIB</h3>
                                <div class="grid gap-6 lg:grid-cols-2">
                                    <div>
                                        <label for="nomor_bc11" class="block text-sm font-medium text-gray-700">Nomor BC 1.1</label>
                                        <input type="text" name="nomor_bc11" id="nomor_bc11" value="{{ old('nomor_bc11') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                    <div>
                                        <label for="tanggal_bc11" class="block text-sm font-medium text-gray-700">Tanggal BC 1.1</label>
                                        <input type="date" name="tanggal_bc11" id="tanggal_bc11" value="{{ old('tanggal_bc11') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                    <div>
                                        <label for="nomor_pos" class="block text-sm font-medium text-gray-700">Nomor Pos</label>
                                        <input type="text" name="nomor_pos" id="nomor_pos" value="{{ old('nomor_pos') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                    <div>
                                        <label for="invoice" class="block text-sm font-medium text-gray-700">Invoice</label>
                                        <input type="text" name="invoice" id="invoice" value="{{ old('invoice') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                    <div>
                                        <label for="tanggal_invoice" class="block text-sm font-medium text-gray-700">Tanggal Invoice</label>
                                        <input type="date" name="tanggal_invoice" id="tanggal_invoice" value="{{ old('tanggal_invoice') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                    <div>
                                        <label for="nomor_bl_awb" class="block text-sm font-medium text-gray-700">Nomor BL/AWB</label>
                                        <input type="text" name="nomor_bl_awb" id="nomor_bl_awb" value="{{ old('nomor_bl_awb') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                    <div>
                                        <label for="tanggal_bl_awb" class="block text-sm font-medium text-gray-700">Tanggal BL/AWB</label>
                                        <input type="date" name="tanggal_bl_awb" id="tanggal_bl_awb" value="{{ old('tanggal_bl_awb') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                    <div>
                                        <label for="negara_asal_barang" class="block text-sm font-medium text-gray-700">Negara Asal Barang</label>
                                        <input type="text" name="negara_asal_barang" id="negara_asal_barang" value="{{ old('negara_asal_barang') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                    <div>
                                        <label for="valuta" class="block text-sm font-medium text-gray-700">Valuta</label>
                                        <input type="text" name="valuta" id="valuta" maxlength="5" value="{{ old('valuta') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                    <div>
                                        <label for="fob" class="block text-sm font-medium text-gray-700">FOB</label>
                                        <input type="number" step="0.01" name="fob" id="fob" value="{{ old('fob') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                    <div>
                                        <label for="freight" class="block text-sm font-medium text-gray-700">Freight</label>
                                        <input type="number" step="0.01" name="freight" id="freight" value="{{ old('freight') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                    <div>
                                        <label for="freight_currency" class="block text-sm font-medium text-gray-700">Freight Currency</label>
                                        <input type="text" name="freight_currency" id="freight_currency" maxlength="5" value="{{ old('freight_currency') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                    <div>
                                        <label for="asuransi" class="block text-sm font-medium text-gray-700">Asuransi</label>
                                        <input type="number" step="0.01" name="asuransi" id="asuransi" value="{{ old('asuransi') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                    <div>
                                        <label for="nilai_cif" class="block text-sm font-medium text-gray-700">Nilai CIF</label>
                                        <input type="number" step="0.01" name="nilai_cif" id="nilai_cif" value="{{ old('nilai_cif') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                </div>
                            </section>

                            <section class="rounded-xl border border-gray-200 bg-gray-50 p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Uraian Barang</h3>
                                <div class="space-y-6">
                                    <div>
                                        <label for="uraian_barang" class="block text-sm font-medium text-gray-700">Uraian Barang</label>
                                        <textarea name="uraian_barang" id="uraian_barang" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('uraian_barang') }}</textarea>
                                    </div>
                                    <div class="grid gap-6 md:grid-cols-2">
                                        <div>
                                            <label for="jumlah_kemasan" class="block text-sm font-medium text-gray-700">Jumlah Kemasan</label>
                                            <input type="number" name="jumlah_kemasan" id="jumlah_kemasan" value="{{ old('jumlah_kemasan') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                        </div>
                                        <div>
                                            <label for="satuan_kemasan" class="block text-sm font-medium text-gray-700">Satuan Kemasan</label>
                                            <input type="text" name="satuan_kemasan" id="satuan_kemasan" value="{{ old('satuan_kemasan') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                        </div>
                                    </div>
                                    <div class="grid gap-6 md:grid-cols-2">
                                        <div>
                                            <label for="berat" class="block text-sm font-medium text-gray-700">Berat</label>
                                            <input type="number" step="0.01" name="berat" id="berat" value="{{ old('berat') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                        </div>
                                        <div>
                                            <label for="satuan" class="block text-sm font-medium text-gray-700">Satuan</label>
                                            <input type="text" name="satuan" id="satuan" value="{{ old('satuan') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                        </div>
                                    </div>
                                    <div class="grid gap-6 md:grid-cols-2">
                                        <div>
                                            <label for="uraian_nilai_cif" class="block text-sm font-medium text-gray-700">Nilai CIF</label>
                                            <input type="number" step="0.01" name="uraian_nilai_cif" id="uraian_nilai_cif" value="{{ old('uraian_nilai_cif') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                        </div>
                                        <div>
                                            <label for="kota_pibk" class="block text-sm font-medium text-gray-700">Kota PIBK</label>
                                            <input type="text" name="kota_pibk" id="kota_pibk" value="{{ old('kota_pibk') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                        </div>
                                    </div>
                                    <div class="grid gap-6 md:grid-cols-2">
                                        <div>
                                            <label for="pemberitahu" class="block text-sm font-medium text-gray-700">Pemberitahu</label>
                                            <input type="text" name="pemberitahu" id="pemberitahu" value="{{ old('pemberitahu') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                        </div>
                                        <div>
                                            <label for="np" class="block text-sm font-medium text-gray-700">NP</label>
                                            <input type="text" name="np" id="np" value="{{ old('np') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                        </div>
                                    </div>
                                    <div class="grid gap-6 md:grid-cols-2">
                                        <div>
                                            <label for="pos_tarif_hs" class="block text-sm font-medium text-gray-700">Pos Tarif/HS</label>
                                            <input type="text" name="pos_tarif_hs" id="pos_tarif_hs" value="{{ old('pos_tarif_hs') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                        </div>
                                        <div>
                                            <label for="ndpbm" class="block text-sm font-medium text-gray-700">NDPBM</label>
                                            <input type="number" step="0.01" name="ndpbm" id="ndpbm" value="{{ old('ndpbm') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                        </div>
                                    </div>
                                    <div class="grid gap-6 md:grid-cols-2">
                                        <div>
                                            <label for="dalam_rupiah" class="block text-sm font-medium text-gray-700">Dalam Rupiah</label>
                                            <input type="number" step="0.01" name="dalam_rupiah" id="dalam_rupiah" value="{{ old('dalam_rupiah') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                        </div>
                                        <div>
                                            <label for="bm" class="block text-sm font-medium text-gray-700">BM</label>
                                            <input type="number" step="0.01" name="bm" id="bm" value="{{ old('bm') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                        </div>
                                    </div>
                                    <div class="grid gap-6 md:grid-cols-2">
                                        <div>
                                            <label for="cukai" class="block text-sm font-medium text-gray-700">Cukai</label>
                                            <input type="number" step="0.01" name="cukai" id="cukai" value="{{ old('cukai') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                        </div>
                                        <div>
                                            <label for="ppn" class="block text-sm font-medium text-gray-700">PPN</label>
                                            <input type="number" step="0.01" name="ppn" id="ppn" value="{{ old('ppn') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                        </div>
                                    </div>
                                    <div class="grid gap-6 md:grid-cols-2">
                                        <div>
                                            <label for="ppnbm" class="block text-sm font-medium text-gray-700">PPNBM</label>
                                            <input type="number" step="0.01" name="ppnbm" id="ppnbm" value="{{ old('ppnbm') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                        </div>
                                        <div>
                                            <label for="pph" class="block text-sm font-medium text-gray-700">PPH</label>
                                            <input type="number" step="0.01" name="pph" id="pph" value="{{ old('pph') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                        </div>
                                    </div>
                                    <div>
                                        <label for="total" class="block text-sm font-medium text-gray-700">Total</label>
                                        <input type="number" step="0.01" name="total" id="total" value="{{ old('total') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                </div>
                            </section>

                            <section class="rounded-xl border border-gray-200 bg-gray-50 p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Pengangkutan</h3>
                                <div class="grid gap-6">
                                    <div>
                                        <label for="cara_pengangkutan" class="block text-sm font-medium text-gray-700">Cara Pengangkutan</label>
                                        <select id="cara_pengangkutan" name="cara_pengangkutan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            <option value="" {{ old('cara_pengangkutan') === '' ? 'selected' : '' }}>Pilih cara pengangkutan</option>
                                            <option value="udara" {{ old('cara_pengangkutan') === 'udara' ? 'selected' : '' }}>Udara</option>
                                            <option value="laut" {{ old('cara_pengangkutan') === 'laut' ? 'selected' : '' }}>Laut</option>
                                            <option value="darat" {{ old('cara_pengangkutan') === 'darat' ? 'selected' : '' }}>Darat</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="nama_sarkut" class="block text-sm font-medium text-gray-700">Nama Sarana Angkut</label>
                                        <input type="text" name="nama_sarkut" id="nama_sarkut" value="{{ old('nama_sarkut') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>

                                    <div>
                                        <label for="no_flight" class="block text-sm font-medium text-gray-700">No. Flight/Voyage</label>
                                        <input type="text" name="no_flight" id="no_flight" value="{{ old('no_flight') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>

                                    <div class="grid gap-6 md:grid-cols-2">
                                        <div>
                                            <label for="pelabuhan_muat" class="block text-sm font-medium text-gray-700">Pelabuhan Muat</label>
                                            <input type="text" name="pelabuhan_muat" id="pelabuhan_muat" value="{{ old('pelabuhan_muat') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                        </div>

                                        <div>
                                            <label for="pelabuhan_bongkar" class="block text-sm font-medium text-gray-700">Pelabuhan Bongkar</label>
                                            <input type="text" name="pelabuhan_bongkar" id="pelabuhan_bongkar" value="{{ old('pelabuhan_bongkar') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <button type="submit" class="inline-flex w-full justify-center rounded-md bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 sm:w-auto">
                                Kirim ke Staff
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
";
Path('d:/xampp/htdocs/databasePKCDT/resources/views/pengguna_jasa/pengajuan/create.blade.php').write_text(content, encoding='utf-8')
PY