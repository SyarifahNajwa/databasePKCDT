<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Proses Surat PIBK</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($errors->any())
                        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">
                            <h3 class="text-sm font-semibold text-red-800">Terdapat kesalahan pada data:</h3>
                            <ul class="mt-3 list-disc list-inside text-sm text-red-700">
                                @foreach($errors->all() as $error)
                                    <li>Nomor Sudah Digunakan</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @php
                        $pengirim = optional($penomoran->pengirim);
                        $penerima = optional($penomoran->penerima);
                        $pemberitahu = optional($penomoran->pemberitahu);
                        $pengangkutan = optional($penomoran->pengangkutan);
                        $pib = optional($penomoran->pib);
                        $uraianBarang = optional($penomoran->uraianBarang);
                        $pemeriksaan = optional($penomoran->pemeriksaan);
                        $pfpd = optional($penomoran->pfpd);
                        $pemeriksa = optional($penomoran->pemeriksa);
                        $jaminan = optional($penomoran->jaminan);

                        $penomoranValue = old('penomoran');
                        $tanggalPibkValue = old('tanggal_pibk');

                        if ($penomoranValue === null && $penomoran->staff_id === null) {
                            $penomoranValue = '';
                        } elseif ($penomoranValue === null) {
                            $penomoranValue = $penomoran->penomoran;
                        }

                        if ($tanggalPibkValue === null && $penomoran->staff_id === null) {
                            $tanggalPibkValue = '';
                        } elseif ($tanggalPibkValue === null) {
                            $tanggalPibkValue = $penomoran->tanggal_pibk?->format('Y-m-d');
                        }
                    @endphp

                    <div class="rounded-xl border border-gray-200 bg-gray-50 p-6 mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Data dari Pemohon</h3>
                        <div class="grid gap-6">
                            <div class="grid gap-2">
                                <p class="text-sm font-medium text-gray-700 font-semibold">Pengirim</p>
                                <p class="text-sm text-gray-600"> Nama Pengirim: <span class="text-gray-600 font-semibold"> {{ $pengirim->nama_pengirim ?? '-' }}</span></p>
                                <p class="text-sm text-gray-600"> Alamat Pengirim: <span class="text-gray-600 font-semibold"> {{ $pengirim->alamat_pengirim ?? '-' }}</span></p>
                            </div>

                            <hr class="my-2">

                            <div class="grid gap-2">
                                <p class="text-sm font-medium text-gray-700 font-semibold">Penerima</p>
                                <p class="text-sm text-gray-600"> Nama Penerima: <span class="text-gray-600 font-semibold"> {{ $penerima->nama_penerima ?? '-' }}</span></p>
                                <p class="text-sm text-gray-600"> Alamat Penerima: <span class="text-gray-600 font-semibold"> {{ $penerima->alamat_penerima ?? '-' }}</span></p>
                                <p class="text-sm text-gray-600">Jenis Identitas: <span class="text-gray-600 font-semibold">{{ $penerima->jenis_identitas_penerima ?? '-' }}</span></p>
                                <p class="text-sm text-gray-600">No. Identitas: <span class="text-gray-600 font-semibold">{{ $penerima->identitas_penerima ?? '-' }}</span></p>
                            </div>

                            <hr class="my-2">

                            <div class="grid gap-2">
                                <p class="text-sm font-medium text-gray-700 font-semibold">Pemberitahu</p>
                                <p class="text-sm text-gray-600"> Nama Pemberitahu: <span class="text-gray-600 font-semibold"> {{ $pemberitahu->nama_pemberitahu ?? '-' }}</span></p>
                                <p class="text-sm text-gray-600"> Alamat Pemberitahu: <span class="text-gray-600 font-semibold"> {{ $pemberitahu->alamat_pemberitahu ?? '-' }}</span></p>
                                <p class="text-sm text-gray-600">Jenis Identitas: <span class="text-gray-600 font-semibold">{{ $pemberitahu->identitas_pemberitahu ?? '-' }}</span></p>
                            </div>

                            <hr class="my-2">

                            <div class="grid gap-2">
                                <p class="text-sm font-medium text-gray-700 font-semibold">Surat Izin PJT/PPJK</p>
                                <p class="text-sm text-gray-800">Nomor: <span class=" text-gray-600 font-semibold">{{ $penomoran->suratIzin?->nomor_surat_izin_pjt_ppjk ?? '-' }}</span></p>
                                <p class="text-sm text-gray-600">Tanggal: <span class="text-gray-600 font-semibold">{{ $penomoran->suratIzin && $penomoran->suratIzin->tanggal_surat_izin_pjt_ppjk ? $penomoran->suratIzin->tanggal_surat_izin_pjt_ppjk->format('d/m/Y') : '-' }}</span></p>
                            </div>

                            <hr class="my-2">

                            <div class="grid gap-2">
                                <p class="text-sm font-medium text-gray-700 font-semibold">Pengangkutan</p>
                                <p class="text-sm text-gray-600">Cara Pengangkutan: <span text-gray-600 class="font-semibold">{{ $pengangkutan->cara_pengangkutan ?? '-' }}</span></p>
                                <p class="text-sm text-gray-600">Sarana: <span class="text-gray-600 font-semibold">{{ $pengangkutan->nama_sarkut ?? '-' }}</span></p>
                                <p class="text-sm text-gray-600">Flight/Voyage: <span class="text-gray-600 font-semibold">{{ $pengangkutan->no_flight ?? '-' }}</span></p>
                                <p class="text-sm text-gray-600">Rute: <span class="text-gray-600 font-semibold">{{ $pengangkutan->pelabuhan_muat ?? '-' }} → {{ $pengangkutan->pelabuhan_bongkar ?? '-' }}</span></p>
                            </div>

                            <hr class="my-2">

                            <div>
                                <p class="text-sm font-medium text-gray-700 mb-3 font-semibold">Data PIB</p>
                                <div class="grid gap-3 md:grid-cols-2 text-sm">
                                    <div>
                                        <p class="text-gray-600">BC 1.1: <span class="text-gray-600 font-semibold">{{ $pib->nomor_bc11 ?? '-' }}</span></p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600">Tgl BC 1.1: <span class="text-gray-600 font-semibold">{{ $pib->tanggal_bc11 ? $pib->tanggal_bc11->format('d/m/Y') : '-' }}</span></p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600">No Pos: <span class="text-gray-600 font-semibold">{{ $pib->nomor_pos ?? '-' }}</span></p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600">Invoice: <span class="text-gray-600 font-semibold">{{ $pib->invoice ?? '-' }}</span></p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600">Tgl Invoice: <span class="text-gray-600 font-semibold">{{ $pib->tanggal_invoice ? $pib->tanggal_invoice->format('d/m/Y') : '-' }}</span></p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600">BL/AWB: <span class="text-gray-600 font-semibold">{{ $pib->nomor_bl_awb ?? '-' }}</span></p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600">Tgl BL/AWB: <span class="text-gray-600 font-semibold">{{ $pib->tanggal_bl_awb ? $pib->tanggal_bl_awb->format('d/m/Y') : '-' }}</span></p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600">Negara Asal: <span class="text-gray-600 font-semibold">{{ $pib->negara_asal_barang ?? '-' }}</span></p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600">Valuta: <span class="text-gray-600 font-semibold">{{ $pib->valuta ?? '-' }}</span></p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600">FOB / Freight / Asuransi: <span class="text-gray-600 font-semibold">{{ $pib->fob ?? '-' }} / {{ $pib->freight ?? '-' }} {{ $pib->freight_currency ?? '' }} / {{ $pib->asuransi ?? '-' }}</span></p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600">Nilai CIF: <span class="text-gray-600 font-semibold">{{ $pib->nilai_cif ?? '-' }}</span></p>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-2">

                            <div>
                                <p class="text-sm font-medium text-gray-700 mb-3 font-semibold">Uraian Barang</p>
                                @php
                                    $uraianList = $penomoran->uraianBarangs ?? ($uraianBarang ? collect([$uraianBarang]) : collect());
                                @endphp
                                @if($uraianList && $uraianList->isNotEmpty())
                                    @foreach($uraianList as $idx => $barang)
                                        <div class="mb-4 rounded border border-gray-100 bg-white p-4 text-sm">
                                            <div class="grid gap-3 md:grid-cols-2">
                                                <div class="md:col-span-2">
                                                    <p class="text-gray-600 mb-2 font-semibold">Item {{ $idx + 1 }}:</p>
                                                    <p class="text-gray-600"> Uraian Barang: <span class="text-gray-600 font-semibold"> {{ $barang->uraian_barang ?? '-' }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-gray-600">Jumlah Kemasan: <span class="text-gray-600 font-semibold">{{ $barang->jumlah_kemasan ?? '-' }}</span></p>
                                                </div>
                                                <div>
                                                    <p class="text-gray-600">Berat: <span class="text-gray-600 font-semibold">{{ $barang->berat ?? '-' }}</span></p>
                                                </div>
                                                <div>
                                                    <p class="text-gray-600">Pos Tarif/HS: <span class="text-gray-600 font-semibold">{{ $barang->pos_tarif_hs ?? '-' }}</span></p>
                                                </div>
                                                <div>
                                                    <p class="text-gray-600">NP: <span class="text-gray-600 font-semibold">{{ $barang->np ?? '-' }}</span></p>
                                                </div>
                                                <div>
                                                    <p class="text-gray-600">NDPBM / Dalam Rupiah: <span class="text-gray-600 font-semibold">{{ $barang->ndpbm ?? '-' }} / {{ $barang->dalam_rupiah ?? '-' }}</span></p>
                                                </div>
                                                <div>
                                                    <p class="text-gray-600">BM / Cukai: <span class="text-gray-600 font-semibold">{{ $barang->bm ?? '-' }} / {{ $barang->cukai ?? '-' }}</span></p>
                                                </div>
                                                <div>
                                                    <p class="text-gray-600">PPN / PPnBM / PPh: <span class="text-gray-600 font-semibold">{{ $barang->ppn ?? '-' }} / {{ $barang->ppnbm ?? '-' }} / {{ $barang->pph ?? '-' }}</span></p>
                                                </div>
                                                <div class="md:col-span-2">
                                                    <p class="text-gray-600">Total: <span class="text-gray-600 font-semibold">{{ $barang->total ?? '-' }}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-sm text-gray-600">Tidak ada data uraian barang.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('staff.pengajuan.update', $penomoran->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="space-y-8">
                            <section class="rounded-xl border border-gray-200 bg-gray-50 p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Nomor & Tanggal Surat</h3>
                                <div class="grid gap-6 md:grid-cols-2">
                                    <div>
                                        <label for="penomoran" class="block text-sm font-medium text-gray-700">Penomoran</label>
                                        <input type="number" placeholder="Masukkan angka bulat tanpa nol di depan. Contoh: 1, 16, 125" name="penomoran" id="penomoran" required value="{{ $penomoranValue }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                    <div>
                                        <label for="tanggal_pibk" class="block text-sm font-medium text-gray-700">Tanggal PIBK</label>
                                        <input type="date" name="tanggal_pibk" id="tanggal_pibk" required value="{{ $tanggalPibkValue }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                </div>
                            </section>

                            <section class="rounded-xl border border-gray-200 bg-gray-50 p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Pemeriksaan</h3>
                                <div class="grid gap-6 lg:grid-cols-2">
                                    <div>
                                        <label for="hari" class="block text-sm font-medium text-gray-700">Hari</label>
                                        <select name="hari" id="hari" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            @php
                                                $hariValue = old('hari', $pemeriksaan->hari ?? '');
                                                $hariOptions = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                                            @endphp
                                            <option value="">Pilih hari</option>
                                            @foreach($hariOptions as $hariOption)
                                                <option value="{{ $hariOption }}" {{ $hariValue === $hariOption ? 'selected' : '' }}>{{ $hariOption }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                                        <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', optional($pemeriksaan->tanggal)->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                    <div>
                                        <label for="jam_mulai_periksa" class="block text-sm font-medium text-gray-700">Jam Mulai Periksa</label>
                                        <input type="time" name="jam_mulai_periksa" id="jam_mulai_periksa" value="{{ old('jam_mulai_periksa', $pemeriksaan->jam_mulai_periksa ? \Carbon\Carbon::parse($pemeriksaan->jam_mulai_periksa)->format('H:i') : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                    <div>
                                        <label for="jam_selesai_periksa" class="block text-sm font-medium text-gray-700">Jam Selesai Periksa</label>
                                        <input type="time" name="jam_selesai_periksa" id="jam_selesai_periksa" value="{{ old('jam_selesai_periksa', $pemeriksaan->jam_selesai_periksa ? \Carbon\Carbon::parse($pemeriksaan->jam_selesai_periksa)->format('H:i') : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                    <div class="lg:col-span-2">
                                        <label for="lokasi_pemeriksaan" class="block text-sm font-medium text-gray-700">Lokasi Pemeriksaan</label>
                                        <input type="text" name="lokasi_pemeriksaan" id="lokasi_pemeriksaan" value="{{ old('lokasi_pemeriksaan', $pemeriksaan->lokasi_pemeriksaan ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>

                                    <hr class="lg:col-span-2 my-4">

                                    <div class="lg:col-span-2">
                                        <h4 class="text-base font-semibold text-gray-800 mb-4">Detail dan Hasil Pemeriksaan</h4>
                                        <div class="grid gap-6 lg:grid-cols-2">
                                            <div>
                                                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                                                <input type="text" name="nama" id="nama" value="{{ old('nama', $pemeriksaan->nama ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                            </div>
                                            <div>
                                                <label for="contoh" class="block text-sm font-medium text-gray-700">Contoh</label>
                                                <input type="text" name="contoh" id="contoh" value="{{ old('contoh', $pemeriksaan->contoh ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                            </div>
                                            <div>
                                                <label for="foto" class="block text-sm font-medium text-gray-700">Foto</label>
                                                <input type="text" name="foto" id="foto" value="{{ old('foto', $pemeriksaan->foto ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                            </div>
                                            <div>
                                                <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan</label>
                                                <input type="text" name="catatan" id="catatan" value="{{ old('catatan', $pemeriksaan->catatan ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="lg:col-span-2 my-4">

                                    <div class="lg:col-span-2">
                                        <h4 class="text-base font-semibold text-gray-800 mb-4">Detail Barang</h4>
                                        <div class="grid gap-6 lg:grid-cols-2">
                                            <div class="lg:col-span-2">
                                                <label for="kondisi_segel" class="block text-sm font-medium text-gray-700">Kondisi Segel</label>
                                                <input type="text" name="kondisi_segel" id="kondisi_segel" value="{{ old('kondisi_segel', $pemeriksaan->kondisi_segel ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                            </div>
                                            <div>
                                                <label for="jumlah_satuan_barang" class="block text-sm font-medium text-gray-700">Jumlah Satuan Barang</label>
                                        <input type="number" name="jumlah_satuan_barang" id="jumlah_satuan_barang" value="{{ old('jumlah_satuan_barang', $pemeriksaan->jumlah_satuan_barang ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                    <div>
                                        <label for="satuan_barang" class="block text-sm font-medium text-gray-700">Satuan Barang</label>
                                        <input type="text" name="satuan_barang" id="satuan_barang" value="{{ old('satuan_barang', $pemeriksaan->satuan_barang ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                    <div>
                                        <label for="jenis_kemasan" class="block text-sm font-medium text-gray-700">Jenis Kemasan</label>
                                        <input type="text" name="jenis_kemasan" id="jenis_kemasan" value="{{ old('jenis_kemasan', $pemeriksaan->jenis_kemasan ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                    <div>
                                        <label for="ukuran_kemasan" class="block text-sm font-medium text-gray-700">Ukuran Kemasan</label>
                                        <input type="text" name="ukuran_kemasan" id="ukuran_kemasan" value="{{ old('ukuran_kemasan', $pemeriksaan->ukuran_kemasan ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                    <div class="lg:col-span-2">
                                        <label for="hasil_uraian_barang" class="block text-sm font-medium text-gray-700">Hasil Uraian Barang</label>
                                        <textarea name="hasil_uraian_barang" id="hasil_uraian_barang" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('hasil_uraian_barang', $pemeriksaan->hasil_uraian_barang ?? '') }}</textarea>
                                    </div>
                                    <div class="lg:col-span-2">
                                        <label for="spesifikasi" class="block text-sm font-medium text-gray-700">Spesifikasi</label>
                                        <textarea name="spesifikasi" id="spesifikasi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('spesifikasi', $pemeriksaan->spesifikasi ?? '') }}</textarea>
                                    </div>
                                    <div class="lg:col-span-2">
                                        <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                                        <textarea name="keterangan" id="keterangan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('keterangan', $pemeriksaan->keterangan ?? '') }}</textarea>
                                    </div>
                                </div>
                            </section>

                            <section class="rounded-xl border border-gray-200 bg-gray-50 p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">PFPD</h3>
                                <div class="grid gap-6 lg:grid-cols-2">
                                    <div>
                                        <label for="nama_pfpd" class="block text-sm font-medium text-gray-700">Nama PFPD</label>
                                        <input type="text" name="nama_pfpd" id="nama_pfpd" value="{{ old('nama_pfpd', $pfpd->nama_pfpd ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                    <div>
                                        <label for="nip_pfpd" class="block text-sm font-medium text-gray-700">NIP PFPD</label>
                                        <input type="text" name="nip_pfpd" id="nip_pfpd" value="{{ old('nip_pfpd', $pfpd->nip_pfpd ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                </div>
                            </section>

                            <section class="rounded-xl border border-gray-200 bg-gray-50 p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Pemeriksa</h3>
                                <div class="grid gap-6 lg:grid-cols-2">
                                    <div>
                                        <label for="nama_pemeriksa" class="block text-sm font-medium text-gray-700">Nama Pemeriksa</label>
                                        <input type="text" name="nama_pemeriksa" id="nama_pemeriksa" value="{{ old('nama_pemeriksa', $pemeriksa->nama_pemeriksa ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                    <div>
                                        <label for="nip_pemeriksa" class="block text-sm font-medium text-gray-700">NIP Pemeriksa</label>
                                        <input type="text" name="nip_pemeriksa" id="nip_pemeriksa" value="{{ old('nip_pemeriksa', $pemeriksa->nip_pemeriksa ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                </div>
                            </section>

                            <section class="rounded-xl border border-gray-200 bg-gray-50 p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Jaminan</h3>
                                <div class="grid gap-6 lg:grid-cols-3">
                                    <div>
                                        <label for="pembayaran" class="block text-sm font-medium text-gray-700">Pembayaran</label>
                                        <input type="text" name="pembayaran" id="pembayaran" value="{{ old('pembayaran', $jaminan->pembayaran ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                    <div>
                                        <label for="jaminan" class="block text-sm font-medium text-gray-700">Jaminan</label>
                                        <input type="text" name="jaminan" id="jaminan" value="{{ old('jaminan', $jaminan->jaminan ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                    <div>
                                        <label for="pejabat_penerima" class="block text-sm font-medium text-gray-700">Pejabat Penerima</label>
                                        <input type="text" name="pejabat_penerima" id="pejabat_penerima" value="{{ old('pejabat_penerima', $jaminan->pejabat_penerima ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                    </div>
                                </div>
                            </section>
                        </div>


                        <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-end">
                            <a href="{{ route('staff.pengajuan.index') }}" class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50">
                                Kembali
                            </a>
                            <button type="submit" class="inline-flex items-center justify-center rounded-md bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                                Simpan & Selesaikan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
