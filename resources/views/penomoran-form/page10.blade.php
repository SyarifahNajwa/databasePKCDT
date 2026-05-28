<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Halaman 10: Review Data & Finalisasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Progress Bar -->
            <x-progress-bar :currentPage="10" :penomoranId="$penomoran->id" />

            <!-- Info Banner -->
            <div class="mb-4 p-4 bg-blue-50 border border-blue-200 rounded-lg text-blue-700 text-sm">
                Periksa kembali semua data yang telah Anda input. Anda dapat kembali ke halaman sebelumnya untuk mengubah data jika diperlukan.
            </div>

            <form method="POST" action="{{ route('penomoran-form.savePage10', $penomoran->id) }}" id="formReview">
                @csrf
                <div class="space-y-4">

                {{-- HALAMAN 1: PENOMORAN --}}
                <section class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="px-6 py-3 border-b bg-gray-50 flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700">1. Penomoran PIBK</h3>
                            <p class="text-xs text-gray-500">Ringkasan nomor dan tanggal dokumen utama.</p>
                        </div>
                        <a href="{{ route('penomoran-form.edit', $penomoran->id) }}" class="text-xs text-yellow-600 hover:text-yellow-800 font-medium">✎ Ubah</a>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-xs uppercase tracking-wide text-slate-500 mb-2">Nomor Penomoran</p>
                            <p class="text-sm font-semibold text-slate-900">{{ $penomoran->penomoran }}</p>
                            <input type="hidden" name="penomoran" value="{{ $penomoran->penomoran }}">
                        </div>
                        <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-xs uppercase tracking-wide text-slate-500 mb-2">Tanggal PIBK</p>
                            <p class="text-sm font-semibold text-slate-900">{{ $penomoran->tanggal_pibk?->format('d-m-Y') ?? '-' }}</p>
                            <input type="hidden" name="tanggal_pibk" value="{{ $penomoran->tanggal_pibk?->format('Y-m-d') ?? '' }}">
                        </div>
                    </div>
                </section>

                {{-- HALAMAN 2: PENGIRIM & PENERIMA --}}
                <section class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="px-6 py-3 border-b bg-gray-50 flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700">2. Pengirim & Penerima</h3>
                            <p class="text-xs text-gray-500">Periksa kembali data alamat pengirim dan penerima.</p>
                        </div>
                        <a href="{{ route('penomoran-form.page2', $penomoran->id) }}" class="text-xs text-yellow-600 hover:text-yellow-800 font-medium">✎ Ubah</a>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <p class="text-xs uppercase tracking-wide text-slate-500">Pengirim</p>
                            <p class="text-sm text-gray-700"><span class="font-medium">Nama:</span> {{ $penomoran->pengirim?->nama_pengirim ?? '-' }}</p>
                            <p class="text-sm text-gray-700"><span class="font-medium">Alamat:</span> {{ $penomoran->pengirim?->alamat_pengirim ?? '-' }}</p>
                        </div>
                        <div class="space-y-3">
                            <p class="text-xs uppercase tracking-wide text-slate-500">Penerima</p>
                            <p class="text-sm text-gray-700"><span class="font-medium">Jenis Identitas:</span> {{ $penomoran->penerima?->jenis_identitas_penerima ?? '-' }}</p>
                            <p class="text-sm text-gray-700"><span class="font-medium">Identitas:</span> {{ $penomoran->penerima?->identitas_penerima ?? '-' }}</p>
                            <p class="text-sm text-gray-700"><span class="font-medium">Nama:</span> {{ $penomoran->penerima?->nama_penerima ?? '-' }}</p>
                            <p class="text-sm text-gray-700"><span class="font-medium">Alamat:</span> {{ $penomoran->penerima?->alamat_penerima ?? '-' }}</p>
                        </div>
                    </div>
                </section>

                {{-- HALAMAN 3: PEMBERITAHU & SURAT IZIN --}}
                <section class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="px-6 py-3 border-b bg-gray-50 flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700">3. Pemberitahu & Surat Izin</h3>
                            <p class="text-xs text-gray-500">Pastikan data pemberitahu dan surat izin sudah sesuai.</p>
                        </div>
                        <a href="{{ route('penomoran-form.page3', $penomoran->id) }}" class="text-xs text-yellow-600 hover:text-yellow-800 font-medium">✎ Ubah</a>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <p class="text-xs uppercase tracking-wide text-slate-500">Pemberitahu</p>
                            <p class="text-sm text-gray-700"><span class="font-medium">Identitas:</span> {{ $penomoran->pemberitahu?->identitas_pemberitahu ?? '-' }}</p>
                            <p class="text-sm text-gray-700"><span class="font-medium">Nama:</span> {{ $penomoran->pemberitahu?->nama_pemberitahu ?? '-' }}</p>
                            <p class="text-sm text-gray-700"><span class="font-medium">Alamat:</span> {{ $penomoran->pemberitahu?->alamat_pemberitahu ?? '-' }}</p>
                        </div>
                        <div class="space-y-3">
                            <p class="text-xs uppercase tracking-wide text-slate-500">Surat Izin</p>
                            <p class="text-sm text-gray-700"><span class="font-medium">Nomor:</span> {{ $penomoran->suratIzin?->nomor_surat_izin_pjt_ppjk ?? '-' }}</p>
                            <p class="text-sm text-gray-700"><span class="font-medium">Tanggal:</span> {{ $penomoran->suratIzin?->tanggal_surat_izin_pjt_ppjk?->format('d-m-Y') ?? '-' }}</p>
                        </div>
                    </div>
                </section>

                {{-- HALAMAN 4: PENGANGKUTAN --}}
                <section class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="px-6 py-3 border-b bg-gray-50 flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700">4. Pengangkutan</h3>
                            <p class="text-xs text-gray-500">Detail angkutan barang impor.</p>
                        </div>
                        <a href="{{ route('penomoran-form.page4', $penomoran->id) }}" class="text-xs text-yellow-600 hover:text-yellow-800 font-medium">✎ Ubah</a>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                        <p><span class="font-medium">Cara Pengangkutan:</span> {{ ucfirst($penomoran->pengangkutan?->cara_pengangkutan ?? '-') }}</p>
                        <p><span class="font-medium">Nama Sarana Angkut:</span> {{ $penomoran->pengangkutan?->nama_sarkut ?? '-' }}</p>
                        <p><span class="font-medium">No. Voy/Flight:</span> {{ $penomoran->pengangkutan?->no_flight ?? '-' }}</p>
                        <p><span class="font-medium">Pelabuhan Muat:</span> {{ $penomoran->pengangkutan?->pelabuhan_muat ?? '-' }}</p>
                        <p><span class="font-medium">Pelabuhan Bongkar:</span> {{ $penomoran->pengangkutan?->pelabuhan_bongkar ?? '-' }}</p>
                    </div>
                </section>

                {{-- HALAMAN 5: PIB --}}
                <section class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="px-6 py-3 border-b bg-gray-50 flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700">5. PIB</h3>
                            <p class="text-xs text-gray-500">Ringkasan dokumen dan nilai impor.</p>
                        </div>
                        <a href="{{ route('penomoran-form.page5', $penomoran->id) }}" class="text-xs text-yellow-600 hover:text-yellow-800 font-medium">✎ Ubah</a>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <p class="text-xs uppercase tracking-wide text-slate-500">Dokumen PIB</p>
                            <p class="text-sm text-gray-700"><span class="font-medium">Nomor BC 1.1:</span> {{ $penomoran->pib?->nomor_bc11 ?? '-' }}</p>
                            <p class="text-sm text-gray-700"><span class="font-medium">Tanggal BC 1.1:</span> {{ $penomoran->pib?->tanggal_bc11?->format('d-m-Y') ?? '-' }}</p>
                            <p class="text-sm text-gray-700"><span class="font-medium">Nomor Pos:</span> {{ $penomoran->pib?->nomor_pos ?? '-' }}</p>
                            <p class="text-sm text-gray-700"><span class="font-medium">Invoice:</span> {{ $penomoran->pib?->invoice ?? '-' }}</p>
                            <p class="text-sm text-gray-700"><span class="font-medium">Tanggal Invoice:</span> {{ $penomoran->pib?->tanggal_invoice?->format('d-m-Y') ?? '-' }}</p>
                            <p class="text-sm text-gray-700"><span class="font-medium">Nomor BL/AWB:</span> {{ $penomoran->pib?->nomor_bl_awb ?? '-' }}</p>
                            <p class="text-sm text-gray-700"><span class="font-medium">Tanggal BL/AWB:</span> {{ $penomoran->pib?->tanggal_bl_awb?->format('d-m-Y') ?? '-' }}</p>
                        </div>
                        <div class="space-y-3">
                            <p class="text-xs uppercase tracking-wide text-slate-500">Nilai PIB</p>
                            <p class="text-sm text-gray-700"><span class="font-medium">Negara Asal:</span> {{ $penomoran->pib?->negara_asal_barang ?? '-' }}</p>
                            <p class="text-sm text-gray-700"><span class="font-medium">Valuta:</span> {{ $penomoran->pib?->valuta ?? '-' }}</p>
                            <p class="text-sm text-gray-700"><span class="font-medium">FOB:</span> {{ $penomoran->pib?->fob !== null ? number_format($penomoran->pib->fob, 2) : '-' }}</p>
                            <p class="text-sm text-gray-700"><span class="font-medium">Freight:</span> {{ $penomoran->pib?->freight_currency ? $penomoran->pib->freight_currency : '-' }} {{ $penomoran->pib?->freight !== null ? number_format($penomoran->pib->freight, 2) : '-' }}</p>
                            <p class="text-sm text-gray-700"><span class="font-medium">Asuransi:</span> {{ $penomoran->pib?->asuransi !== null ? number_format($penomoran->pib->asuransi, 2) : '-' }}</p>
                            <p class="text-sm text-gray-700"><span class="font-medium">Nilai CIF:</span> {{ $penomoran->pib?->nilai_cif !== null ? number_format($penomoran->pib->nilai_cif, 2) : '-' }}</p>
                        </div>
                    </div>
                </section>

                {{-- HALAMAN 6: URAIAN BARANG --}}
                <section class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="px-6 py-3 border-b bg-gray-50 flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700">6. Uraian Barang</h3>
                            <p class="text-xs text-gray-500">Total item: {{ $penomoran->uraianBarangs->count() }}</p>
                        </div>
                        <a href="{{ route('penomoran-form.page6', $penomoran->id) }}" class="text-xs text-yellow-600 hover:text-yellow-800 font-medium">✎ Ubah</a>
                    </div>
                    <div class="p-6 space-y-4">
                        @forelse($penomoran->uraianBarangs as $idx => $barang)
                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                <p class="text-xs font-semibold text-gray-500 uppercase mb-3">Barang {{ $idx + 1 }}</p>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm text-gray-700">
                                    <p><span class="font-medium">Uraian:</span> {{ $barang->uraian_barang ?? '-' }}</p>
                                    <p><span class="font-medium">Jumlah Kemasan:</span> {{ $barang->jumlah_kemasan ?? '-' }} {{ $barang->satuan_kemasan ? '(' . $barang->satuan_kemasan . ')' : '' }}</p>
                                    <p><span class="font-medium">Berat:</span> {{ $barang->berat ?? '-' }} {{ $barang->satuan ? '(' . $barang->satuan . ')' : '' }}</p>
                                    <p><span class="font-medium">Nilai CIF:</span> {{ $barang->nilai_cif !== null ? number_format($barang->nilai_cif, 2) : '-' }}</p>
                                    <p><span class="font-medium">Total Pajak:</span> {{ $barang->total !== null ? number_format($barang->total, 2) : '-' }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-400">Tidak ada data uraian barang.</p>
                        @endforelse
                    </div>
                </section>

                {{-- HALAMAN 7: PEMERIKSAAN --}}
                <section class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="px-6 py-3 border-b bg-gray-50 flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700">7. Pemeriksaan</h3>
                            <p class="text-xs text-gray-500">Saring data hasil pemeriksaan sebelum finalisasi.</p>
                        </div>
                        <a href="{{ route('penomoran-form.page7', $penomoran->id) }}" class="text-xs text-yellow-600 hover:text-yellow-800 font-medium">✎ Ubah</a>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                        <div class="space-y-2">
                            <p><span class="font-medium">Hari:</span> {{ $penomoran->pemeriksaan?->hari ?? '-' }}</p>
                            <p><span class="font-medium">Tanggal:</span> {{ $penomoran->pemeriksaan?->tanggal?->format('d-m-Y') ?? '-' }}</p>
                            <p><span class="font-medium">Jam Mulai:</span> {{ $penomoran->pemeriksaan?->jam_mulai_periksa?->format('H:i') ?? '-' }} WIB</p>
                            <p><span class="font-medium">Jam Selesai:</span> {{ $penomoran->pemeriksaan?->jam_selesai_periksa?->format('H:i') ?? '-' }} WIB</p>
                        </div>
                        <div class="space-y-2">
                            <p><span class="font-medium">Nama:</span> {{ $penomoran->pemeriksaan?->nama ?? '-' }}</p>
                            <p><span class="font-medium">Contoh:</span> {{ $penomoran->pemeriksaan?->contoh ?? '-' }}</p>
                            <p><span class="font-medium">Lokasi:</span> {{ $penomoran->pemeriksaan?->lokasi_pemeriksaan ?? '-' }}</p>
                            <p><span class="font-medium">Kondisi Segel:</span> {{ $penomoran->pemeriksaan?->kondisi_segel ?? '-' }}</p>
                            <p><span class="font-medium">Jumlah Satuan:</span> {{ $penomoran->pemeriksaan?->jumlah_satuan_barang ?? '-' }} {{ $penomoran->pemeriksaan?->satuan_barang ?? '' }}</p>
                        </div>
                    </div>
                </section>

                {{-- HALAMAN 8: PETUGAS --}}
                <section class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="px-6 py-3 border-b bg-gray-50 flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700">8. Petugas</h3>
                            <p class="text-xs text-gray-500">Data PFPD dan Pemeriksa.</p>
                        </div>
                        <a href="{{ route('penomoran-form.page8', $penomoran->id) }}" class="text-xs text-yellow-600 hover:text-yellow-800 font-medium">✎ Ubah</a>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-700">
                        <div class="space-y-2">
                            <p class="text-xs uppercase tracking-wide text-slate-500">PFPD</p>
                            <p><span class="font-medium">Nama:</span> {{ $penomoran->pfpd?->nama_pfpd ?? '-' }}</p>
                            <p><span class="font-medium">NIP:</span> {{ $penomoran->pfpd?->nip_pfpd ?? '-' }}</p>
                        </div>
                        <div class="space-y-2">
                            <p class="text-xs uppercase tracking-wide text-slate-500">Pemeriksa</p>
                            <p><span class="font-medium">Nama:</span> {{ $penomoran->pemeriksa?->nama_pemeriksa ?? '-' }}</p>
                            <p><span class="font-medium">NIP:</span> {{ $penomoran->pemeriksa?->nip_pemeriksa ?? '-' }}</p>
                        </div>
                    </div>
                </section>

                {{-- HALAMAN 9: JAMINAN --}}
                <section class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="px-6 py-3 border-b bg-gray-50 flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700">9. Jaminan</h3>
                            <p class="text-xs text-gray-500">Pastikan informasi jaminan dan pejabat penerima benar.</p>
                        </div>
                        <a href="{{ route('penomoran-form.page9', $penomoran->id) }}" class="text-xs text-yellow-600 hover:text-yellow-800 font-medium">✎ Ubah</a>
                    </div>
                    <div class="p-6 grid grid-cols-1 gap-4 text-sm text-gray-700">
                        <div class="space-y-2">
                            <p><span class="font-medium">Pembayaran:</span> {{ $penomoran->jaminan?->pembayaran ?? '-' }}</p>
                            <p><span class="font-medium">Jaminan:</span> {{ $penomoran->jaminan?->jaminan ?? '-' }}</p>
                            <p><span class="font-medium">Pejabat Penerima:</span> {{ $penomoran->jaminan?->pejabat_penerima ?? '-' }}</p>
                        </div>
                    </div>
                </section>

                <hr class="my-6">

                <!-- Navigasi Akhir -->
                <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                    <div class="flex flex-wrap gap-3 items-center">
                        <a href="{{ route('penomoran-form.back', [$penomoran->id, 10]) }}" class="text-gray-600 hover:text-gray-800">← Kembali</a>
                        <button type="button" onclick="openPrintDirect('print')" class="inline-flex items-center gap-2 px-4 py-2 bg-sky-500 hover:bg-sky-600 text-white text-sm font-medium rounded-md transition">⎙ Cetak PIBK</button>
                        <button type="button" onclick="openPrintDirect('printIp')" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md transition">⎙ Cetak Surat IP</button>
                        <button type="button" onclick="openPrintDirect('printSppb')" class="inline-flex items-center gap-2 px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-md transition">⎙ Cetak SPPB</button>
                        <button type="button" onclick="openPrintDirect('printLhpIp')" class="inline-flex items-center gap-2 px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white text-sm font-medium rounded-md transition">⎙ Cetak LHP IP</button>
                    </div>
                    <x-primary-button class="bg-green-600 hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:ring-green-500">
                        ✓ {{ __('Finalisasi Data') }}
                    </x-primary-button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <script>
        function openPrintDirect(doc){
            var id = {{ $penomoran->id }};
            var base = "{{ url('/penomoran-form') }}" + '/' + id;
            var url = base + '/print';
            if(doc === 'printIp') url = base + '/print-ip';
            if(doc === 'printSppb') url = base + '/print-sppb';
            if(doc === 'printLhpIp') url = base + '/print-lhp-ip';

            var iframeId = 'printFrameHidden';
            var iframe = document.getElementById(iframeId);
            if(!iframe){
                iframe = document.createElement('iframe');
                iframe.id = iframeId;
                iframe.style.position = 'absolute';
                iframe.style.left = '-9999px';
                iframe.style.width = '0px';
                iframe.style.height = '0px';
                iframe.style.border = '0';
                document.body.appendChild(iframe);
            }

            var handled = false;

            iframe.onload = function(){
                try{
                    if(iframe.contentWindow){
                        iframe.contentWindow.focus();
                        iframe.contentWindow.print();
                        handled = true;
                    }
                }catch(e){
                    handled = false;
                }
            };

            // Start loading printable page into iframe
            iframe.src = url;

            // Fallback: if printing not initiated within 5s, navigate current tab to printable page
            setTimeout(function(){
                if(!handled){
                    window.location.href = url;
                }
            }, 5000);
        }
    </script>
</x-app-layout>
