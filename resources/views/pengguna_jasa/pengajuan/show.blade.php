<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Pengajuan</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-6">
                <div class="rounded-xl border border-gray-200 bg-white shadow-sm">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Status Pengajuan</h3>
                        @php
                            $status = $penomoran->status_pengajuan;
                            $badgeClass = 'bg-gray-100 text-gray-700';
                            $statusLabel = $status ?? '-';

                            if ($status === 'pending_staff') {
                                $badgeClass = 'bg-yellow-100 text-yellow-800';
                                $statusLabel = 'Menunggu Staff';
                            } elseif ($status === 'selesai') {
                                $badgeClass = 'bg-green-100 text-green-800';
                                $statusLabel = 'Selesai';
                            }
                        @endphp

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                            <div class="space-y-3">
                                <div class="inline-flex items-center gap-2">
                                    <span class="rounded-full px-3 py-1 text-sm font-semibold {{ $badgeClass }}">{{ $statusLabel }}</span>
                                </div>
                                <div class="text-sm text-gray-600">
                                    <p class="font-medium text-gray-800">Tgl Submit</p>
                                    <p>{{ $penomoran->submitted_by_pengguna_at?->format('d M Y H:i') ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid gap-6 xl:grid-cols-2">
                    <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Pengirim</h3>
                        <div class="space-y-4 text-sm text-gray-700">
                            <div>
                                <p class="font-medium text-gray-800">Nama Pengirim</p>
                                <p>{{ $penomoran->pengirim?->nama_pengirim ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Alamat Pengirim</p>
                                <p>{{ $penomoran->pengirim?->alamat_pengirim ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Penerima</h3>
                        <div class="space-y-4 text-sm text-gray-700">
                            <div>
                                <p class="font-medium text-gray-800">Jenis Identitas</p>
                                <p>{{ $penomoran->penerima?->jenis_identitas_penerima ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Nomor Identitas</p>
                                <p>{{ $penomoran->penerima?->identitas_penerima ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Nama Penerima</p>
                                <p>{{ $penomoran->penerima?->nama_penerima ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Alamat Penerima</p>
                                <p>{{ $penomoran->penerima?->alamat_penerima ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Pemberitahu</h3>
                        <div class="space-y-4 text-sm text-gray-700">
                            <div>
                                <p class="font-medium text-gray-800">Identitas Pemberitahu</p>
                                <p>{{ $penomoran->pemberitahu?->identitas_pemberitahu ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Nama Pemberitahu</p>
                                <p>{{ $penomoran->pemberitahu?->nama_pemberitahu ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Alamat Pemberitahu</p>
                                <p>{{ $penomoran->pemberitahu?->alamat_pemberitahu ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Surat Izin PJT / PPJK</h3>
                        <div class="space-y-4 text-sm text-gray-700">
                            <div>
                                <p class="font-medium text-gray-800">Nomor Surat Izin</p>
                                <p>{{ $penomoran->suratIzin?->nomor_surat_izin_pjt_ppjk ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Tanggal Surat Izin</p>
                                <p>{{ $penomoran->suratIzin?->tanggal_surat_izin_pjt_ppjk?->format('d/m/Y') ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Pengangkutan</h3>
                    <div class="space-y-4 text-sm text-gray-700">
                        <div>
                            <p class="font-medium text-gray-800">Cara Pengangkutan</p>
                            <p>{{ $penomoran->pengangkutan?->cara_pengangkutan ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Sarana Angkut</p>
                            <p>{{ $penomoran->pengangkutan?->nama_sarkut ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Pelabuhan Muat</p>
                            <p>{{ $penomoran->pengangkutan?->pelabuhan_muat ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Pelabuhan Bongkar</p>
                            <p>{{ $penomoran->pengangkutan?->pelabuhan_bongkar ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">No. Flight</p>
                            <p>{{ $penomoran->pengangkutan?->no_flight ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Data PIB</h3>
                    @php
                        $pib = $penomoran->pib;
                    @endphp
                    <div class="grid gap-4 md:grid-cols-2 text-sm text-gray-700">
                        <div>
                            <p class="font-medium text-gray-800">Nomor BC 1.1</p>
                            <p>{{ $pib?->nomor_bc11 ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Tanggal BC 1.1</p>
                            <p>{{ $pib?->tanggal_bc11?->format('d/m/Y') ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Nomor Pos</p>
                            <p>{{ $pib?->nomor_pos ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Invoice</p>
                            <p>{{ $pib?->invoice ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Tanggal Invoice</p>
                            <p>{{ $pib?->tanggal_invoice?->format('d/m/Y') ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">BL/AWB</p>
                            <p>{{ $pib?->nomor_bl_awb ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Tanggal BL/AWB</p>
                            <p>{{ $pib?->tanggal_bl_awb?->format('d/m/Y') ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Negara Asal Barang</p>
                            <p>{{ $pib?->negara_asal_barang ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Valuta</p>
                            <p>{{ $pib?->valuta ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">FOB</p>
                            <p>{{ $pib?->fob !== null ? $pib->formatDecimal($pib->fob) : '-' }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Freight</p>
                            <p>{{ $pib?->freight_currency ?? '-' }} {{ $pib?->freight !== null ? $pib->formatDecimal($pib->freight) : '-' }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Asuransi</p>
                            <p>{{ $pib?->asuransi !== null ? $pib->formatDecimal($pib->asuransi) : '-' }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Nilai CIF</p>
                            <p>{{ $pib?->nilai_cif !== null ? $pib->formatDecimal($pib->nilai_cif) : '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Uraian Barang</h3>
                    @if($penomoran->uraianBarangs->isNotEmpty())
                        @foreach($penomoran->uraianBarangs as $idx => $barang)
                            <div class="space-y-4 border-b border-gray-200 py-4 last:border-b-0 last:pb-0">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-semibold text-gray-800">Item {{ $idx + 1 }}</p>
                                </div>
                                <div class="grid gap-4 md:grid-cols-2 text-sm text-gray-700">
                                    <div>
                                        <p class="font-medium text-gray-800">Uraian Barang</p>
                                        <p>{{ $barang->uraian_barang ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">Jumlah Kemasan</p>
                                        <p>{{ $barang->jumlah_kemasan ?? '-' }} {{ $barang->satuan_kemasan ?? '' }}</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">Berat</p>
                                        <p>{{ $barang->berat !== null ? $barang->formatDecimal($barang->berat) : '-' }} {{ $barang->satuan ?? '' }}</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">Nilai CIF</p>
                                        <p>{{ $barang->nilai_cif !== null ? $barang->formatDecimal($barang->nilai_cif) : '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">Kota PIBK</p>
                                        <p>{{ $barang->kota_pibk ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">Pos Tarif / HS</p>
                                        <p>{{ $barang->pos_tarif_hs ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">Pemberitahu</p>
                                        <p>{{ $barang->pemberitahu ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">NP</p>
                                        <p>{{ $barang->np ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">NDPBM</p>
                                        <p>{{ $barang->ndpbm !== null ? $barang->formatDecimal($barang->ndpbm) : '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">Dalam Rupiah</p>
                                        <p>{{ $barang->dalam_rupiah !== null ? $barang->formatDecimal($barang->dalam_rupiah) : '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">BM</p>
                                        <p>{{ $barang->bm !== null ? $barang->formatDecimal($barang->bm) : '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">Cukai</p>
                                        <p>{{ $barang->cukai !== null ? $barang->formatDecimal($barang->cukai) : '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">PPN</p>
                                        <p>{{ $barang->ppn !== null ? $barang->formatDecimal($barang->ppn) : '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">PPnBM</p>
                                        <p>{{ $barang->ppnbm !== null ? $barang->formatDecimal($barang->ppnbm) : '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">PPh</p>
                                        <p>{{ $barang->pph !== null ? $barang->formatDecimal($barang->pph) : '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">Total</p>
                                        <p>{{ $barang->total !== null ? $barang->formatDecimal($barang->total) : '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-sm text-gray-600">Tidak ada data uraian barang.</p>
                    @endif
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('pengguna-jasa.pengajuan.index') }}" class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-5 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                        Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
