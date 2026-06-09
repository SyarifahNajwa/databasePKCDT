{{--
    VARIABEL YANG DIBUTUHKAN DI CONTROLLER:
    ----------------------------------------
    $penomoran   → model Penomoran (tabel: penomoran)

    Relasi yang harus ada di model Penomoran:
      - pengirim()      → hasOne(Pengirim::class)
      - penerima()      → hasOne(Penerima::class)
      - pemberitahu()   → hasOne(Pemberitahu::class)
      - pengangkutan()  → hasOne(Pengangkutan::class)
      - suratIzin()     → hasOne(SuratIzin::class)
      - pib()           → hasOne(Pib::class)
      - uraianBarang()  → hasOne(UraianBarang::class)
      - pemeriksaan()   → hasOne(Pemeriksaan::class)
      - pemeriksa()     → hasOne(Pemeriksa::class)
      - pfpd()          → hasOne(Pfpd::class)
      - jaminan()       → hasOne(Jaminan::class)

    Contoh controller:
      $penomoran = Penomoran::with([
          'pengirim','penerima','pemberitahu','pengangkutan',
          'suratIzin','pib','uraianBarang','pemeriksaan',
          'pemeriksa','pfpd','jaminan'
      ])->findOrFail($id);
      return view('pibk.print', compact('penomoran'));
--}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PIBK - {{ $penomoran->formatted_penomoran ?? '' }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 9pt; background: #fff; color: #000; }
        .page { width: 210mm; min-height: 297mm; margin: 0 auto; padding: 8mm; }
        @media print {
            body { margin: 0; }
            .page { width: 100%; padding: 5mm 6mm; margin: 0; }
        }
        .title {
            text-align: center; font-size: 11pt; font-weight: bold;
            border: 1.5px solid #000; padding: 4px; margin-bottom: -1px;
        }
        table.main { width: 100%; border-collapse: collapse; }
        table.main td { border: 1px solid #000; padding: 1px 3px; vertical-align: top; font-size: 8.5pt; }
        table.inner { width: 100%; border-collapse: collapse; }
        table.inner td { border: none; padding: 1px 3px; vertical-align: top; font-size: 8.5pt; }
        .label  { font-weight: bold; }
        .center { text-align: center; }
        .right  { text-align: right; }
        .section-header { font-weight: bold; background-color: #f0f0f0; }
    </style>
</head>
<body>
<div class="page">

    {{-- JUDUL --}}
    <div class="title">Pemberitahuan Impor Barang Khusus (PIBK)</div>

    {{-- ══ A. UNTUK ══ --}}
    <table class="main">
        <tr>
            <td style="width:8%; border-right:none; font-weight:bold;" class="label">A. Untuk</td>
            <td style="width:28%; border-left:none; font-weight:bold;">1. Barang Pindahan Penumpang</td>
            <td style="width:32%; font-weight:bold;">2. Barang Kiriman Melalui PJT</td>
            <td style="width:32%; font-weight:bold;">3. Barang Impor Sementara Dibawa</td>
        </tr>
        <tr>
            <td style="border-right:none; border-top:none;"></td>
            <td style="border-left:none; border-top:none; font-weight:bold;">4. Barang Impor Tertentu</td>
            <td style="font-weight:bold;">5. Barang Pribadi Penumpang</td>
            <td style="font-weight:bold;">9. Lainnya</td>
        </tr>
    </table>

    {{-- ══ B. DATA PEMBERITAHUAN + D. DIISI BEA CUKAI ══ --}}
    <table class="main" style="margin-top:-1px;">
        <tr>
            <td colspan="5" class="section-header" style="width:55%;">B. DATA PEMBERITAHUAN</td>
            <td colspan="5" class="section-header" style="width:45%;">D. DIISI OLEH BEA DAN CUKAI :</td>
        </tr>

        {{-- 1. Nama Pengirim --}}
        <tr>
            <td colspan="5" rowspan="6" style="vertical-align:top; padding: 5px;">
                <div style="font-weight:bold; margin-bottom: 4px;">1. Nama, Alamat Pengirim Barang :</div>
                <div style="line-height: 1.4;">
                    {{ $penomoran->pengirim?->nama_pengirim ?? '-' }}<br>
                    {{ $penomoran->pengirim?->alamat_pengirim ?? '' }}
                </div>
            </td>
            <td colspan="2" class="label" style="width:20%;">Nopen</td>
            <td colspan="3">
                {{ $penomoran->formatted_penomoran ?? '-' }} /PIBK/RH/{{ $penomoran->tanggal_pibk ? \Carbon\Carbon::parse($penomoran->tanggal_pibk)->format('Y') : date('Y') }}
            </td>
        </tr>
        <tr>
            <td colspan="2" class="label">Tanggal Nopen</td>
            <td colspan="3">
                {{ $penomoran->tanggal_pibk ? \Carbon\Carbon::parse($penomoran->tanggal_pibk)->translatedFormat('d F Y') : '-' }}
            </td>
        </tr>
        <tr>
            <td colspan="2" class="label">Kantor Pabean</td>
            <td colspan="3">130100</td>
        </tr>
        <tr>
            <td class="label">No. BC 1.1</td>
            <td>{{ $penomoran->pib?->nomor_bc11 ?? '-' }}</td>
            <td class="label">Tgl</td>
            <td colspan="2">
                {{ $penomoran->pib?->tanggal_bc11 ? \Carbon\Carbon::parse($penomoran->pib->tanggal_bc11)->translatedFormat('d F Y') : '-' }}
            </td>
        </tr>
        <tr>
            <td colspan="2" class="label">Pos</td>
            <td colspan="3" class="label">Sub Pos</td>
        </tr>
        <tr>
            <td colspan="2">{{ $penomoran->pib?->nomor_pos ?? '-' }}</td>
            <td colspan="3">-</td>
        </tr>

        {{-- 2. Identitas Penerima & 11. Invoice --}}
        <tr>
            <td colspan="5" rowspan="2" style="vertical-align:top; padding: 5px;">
                <div class="label">2. Identitas Penerima Barang :</div>
                <div style="margin-top: 4px;">{{ $penomoran->penerima?->identitas_penerima ?? '-' }}</div>
            </td>
            <td colspan="2" class="label">11. Invoice :</td>
            <td colspan="3" class="label">Tgl :</td>
        </tr>
        <tr>
            <td colspan="2">{{ $penomoran->pib?->invoice ?? '-' }}</td>
            <td colspan="3">
                {{ $penomoran->pib?->tanggal_invoice ? \Carbon\Carbon::parse($penomoran->pib->tanggal_invoice)->translatedFormat('d F Y') : '-' }}
            </td>
        </tr>

        {{-- 3. Nama Penerima & 12. BL/AWB --}}
        <tr>
            <td colspan="5" rowspan="2" style="vertical-align:top; padding: 5px;">
                <div class="label">3. Nama, Alamat Penerima Barang :</div>
                <div style="margin-top: 4px; line-height: 1.4;">
                    {{ $penomoran->penerima?->nama_penerima ?? '-' }}<br>
                    {{ $penomoran->penerima?->alamat_penerima ?? '' }}
                </div>
            </td>
            <td colspan="2" class="label">12. BL/AWB :</td>
            <td colspan="3" class="label">Tgl :</td>
        </tr>
        <tr>
            <td colspan="2">{{ $penomoran->pib?->nomor_bl_awb ?? '-' }}</td>
            <td colspan="3">
                {{ $penomoran->pib?->tanggal_bl_awb ? \Carbon\Carbon::parse($penomoran->pib->tanggal_bl_awb)->translatedFormat('d F Y') : '-' }}
            </td>
        </tr>
        

        {{-- 4. Identitas Pemberitahu [tabel: pemberitahu → identitas_pemberitahu] --}}
        {{-- 13. Negara Asal [tabel: pib → negara_asal_barang] --}}
        <tr>
            <td colspan="5" class="label">4. Identitas Pemberitahu :</td>
            <td colspan="5" class="label">13. Negara Asal Barang :</td>
        </tr>
        <tr>
            <td colspan="5">{{ $penomoran->pemberitahu?->identitas_pemberitahu ?? '-' }}</td>
            <td colspan="5">{{ $penomoran->pib?->negara_asal_barang ?? '-' }}</td>
        </tr>

        {{-- 5. Nama Pemberitahu & 14. Valuta --}}
<tr>
    <td colspan="5" class="label" style="border-bottom: 1px solid #000;">5. Nama, Alamat Pemberitahu :</td>
    <td colspan="5" class="label" style="border-bottom: 1px solid #000;">14. Valuta</td>
</tr>
<tr>
    {{-- Baris isi untuk Nama & Alamat (Kiri) --}}
    <td colspan="5" style="border-bottom: 1px solid #000; min-height: 35px;">
        {{ $penomoran->pemberitahu?->nama_pemberitahu ?? '-' }}<br>
        {{ $penomoran->pemberitahu?->alamat_pemberitahu ?? '' }}
    </td>
    {{-- Baris isi untuk Valuta (Kanan) --}}
    <td colspan="5" style="border-bottom: 1px solid #000; vertical-align: top;">
        {{ $penomoran->pib?->valuta ?? '-' }}
    </td>
</tr>

        {{-- 6. Surat Izin PJT [tabel: surat_izin → nomor_surat_izin_pjt_ppjk, tanggal_surat_izin_pjt_ppjk] --}}
        {{-- 15. FOB [tabel: pib → fob, valuta] --}}
        <tr>
            <td colspan="5" class="label">6. No. &amp; Tgl. Surat Izin PJT/NP-PPJK :</td>
            <td colspan="5" class="label">15. FOB</td>
        </tr>
        <tr>
            <td colspan="5">
                {{ $penomoran->suratIzin?->nomor_surat_izin_pjt_ppjk ?? '-' }}
                @if($penomoran->suratIzin?->tanggal_surat_izin_pjt_ppjk)
                    / {{ \Carbon\Carbon::parse($penomoran->suratIzin->tanggal_surat_izin_pjt_ppjk)->translatedFormat('d F Y') }}
                @endif
            </td>
            <td colspan="5">
                {{ $penomoran->pib?->valuta ?? '' }}
                {{ $penomoran->pib?->fob !== null ? $penomoran->pib->formatDecimal($penomoran->pib->fob) : '-' }}
            </td>
        </tr>

        {{-- 7. Cara Pengangkutan [tabel: pengangkutan → cara_pengangkutan] --}}
        {{-- 16. Freight [tabel: pib → freight, freight_currency] --}}
        <tr>
            <td colspan="5" class="label">7. Cara Pengangkutan :</td>
            <td colspan="5" class="label">16. Freight</td>
        </tr>
        <tr>
            <td colspan="5">{{ strtoupper($penomoran->pengangkutan?->cara_pengangkutan ?? '-') }}</td>
            <td colspan="5">
                {{ $penomoran->pib?->freight_currency ?? '' }}
                {{ $penomoran->pib?->freight !== null ? $penomoran->pib->formatDecimal($penomoran->pib->freight) : '-' }}
            </td>
        </tr>

        {{-- 8. Nama Sarkut [tabel: pengangkutan → nama_sarkut, no_flight] --}}
        {{-- 17. Asuransi [tabel: pib → asuransi, valuta] --}}
        <tr>
            <td colspan="5" class="label">8. Nama Sarana Pengangkut &amp; No. Voy/Flight :</td>
            <td colspan="5" class="label">17. Asuransi</td>
        </tr>
        <tr>
            {{-- Bagian 8: Terdiri dari 2 baris teks --}}
            <td colspan="5" style="border-bottom: 1px solid #000;">
                {{ $penomoran->pengangkutan?->nama_sarkut ?? '-' }}<br>
                {{ $penomoran->pengangkutan?->no_flight ?? '' }}
            </td>
            {{-- Bagian 17: Satu kotak bersih tanpa garis tengah, tapi tinggi selaras dengan kiri --}}
            <td colspan="5" style="border-bottom: 1px solid #000; vertical-align: top;">
                {{ $penomoran->pib?->valuta ?? '' }}
                {{ $penomoran->pib?->asuransi !== null ? $penomoran->pib->formatDecimal($penomoran->pib->asuransi) : '-' }}
            </td>
        </tr>

        {{-- 9 & 10. Pelabuhan [tabel: pengangkutan → pelabuhan_muat, pelabuhan_bongkar] --}}
        {{-- 18. Nilai CIF [tabel: pib → nilai_cif, valuta] --}}
        <tr>
            <td colspan="2" class="label">9. Pelabuhan Muat :</td>
            <td colspan="3" class="label">10. Pelabuhan Bongkar :</td>
            <td colspan="5" class="label">18. Nilai CIF</td>
        </tr>
        <tr>
            <td colspan="2">{{ $penomoran->pengangkutan?->pelabuhan_muat ?? '-' }}</td>
            <td colspan="3">{{ $penomoran->pengangkutan?->pelabuhan_bongkar ?? '-' }}</td>
            <td colspan="5">
                {{ $penomoran->pib?->valuta ?? '' }}
                {{ $penomoran->pib?->nilai_cif !== null ? $penomoran->pib->formatDecimal($penomoran->pib->nilai_cif) : '-' }}
            </td>
        </tr>

        {{-- 19–22 [tabel: uraian_barang → uraian_barang, jumlah_kemasan, satuan_kemasan, berat, satuan, nilai_cif] --}}
        <tr>
            <td class="label center" style="width:4%;">19. No</td>
            <td colspan="4" class="label center">20. Uraian Barang</td>
            <td colspan="3" class="label center">21. Jumlah &amp; Jenis Satuan</td>
            <td colspan="2" class="label center">22. Nilai CIF</td>
        </tr>
        @forelse($penomoran->uraianBarangs as $idx => $barang)
            <tr>
                <td class="center">{{ $idx + 1 }}</td>
                <td colspan="4" style="text-align: center;">
                    {{ $barang->uraian_barang ?? '-' }}
                </td>
                <td colspan="3" style="text-align: center;">
                    {{ $barang->jumlahJenisSatuan }}
                </td>
                <td colspan="2" class="right" style="text-align: center;">
                    {{ $barang->nilai_cif !== null ? $barang->formatDecimal($barang->nilai_cif) : '-' }}
                </td>
            </tr>
        @empty
            <tr>
                <td class="center">-</td>
                <td colspan="4" style="text-align: center;">-</td>
                <td colspan="3" style="text-align: center;">-</td>
                <td colspan="2" class="right" style="text-align: center;">-</td>
            </tr>
        @endforelse

        {{-- C. Pernyataan + TTD Pemberitahu [tabel: uraian_barang → kota_pibk, pemberitahu] --}}
        <tr>
            <td colspan="5" style="height:70px; vertical-align:bottom; border-right:none;"></td>
            <td colspan="5" style="vertical-align:top; font-size:9pt; font-weight:bold; text-align:center;">
                C. Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal yang diberitahukan dalam dokumen ini.
                <br><br>
                {{ $penomoran->display_kota_pibk }},
                {{ $penomoran->tanggal_pibk ? \Carbon\Carbon::parse($penomoran->tanggal_pibk)->translatedFormat('d F Y') : '-' }}
                <br><span class="label">PEMBERITAHU</span>
                <br><br><br>
                <div class="center">
                    {{ $penomoran->penerima?->nama_penerima ?? '-' }}
                </div>
            </td>
        </tr>
    </table>

    {{-- ══ E. HASIL PEMERIKSAAN ══ --}}
    <table class="main" style="margin-top:-1px;">
        <tr>
            <td colspan="10" class="section-header">E. HASIL PEMERIKSAAN / PENETAPAN PEJABAT BEA DAN CUKAI</td>
        </tr>
        <tr>
            <td class="label center" style="width:4%;">23. No</td>
            <td colspan="4" class="label left" style="width:36%;">
                24. Uraian barang secara lengkap meliputi jenis, jumlah, merek, tipe, ukuran dan spesifikasi lainnya
            </td>
            <td colspan="2" class="label center" style="width:18%;">25. Jumlah &amp; Jenis Satuan</td>
            <td colspan="2" class="label center" style="width:18%;">26. Nilai Pabean</td>
            <td class="label center" style="width:24%;">
                27. - Pos Tarif / HS<br>&nbsp;&nbsp;&nbsp;- Tarif BM, Cukai, PPN, PPnBM, PPh
            </td>
        </tr>
        <tr>
            <td class="center">1</td>
            {{-- [tabel: pemeriksaan → spesifikasi] fallback ke uraian_barang → uraian_barang --}}
            <td colspan="4" style="text-align: center;">{{ $penomoran->uraianBarang?->uraian_barang ?? '-' }}</td>
            {{-- [tabel: pemeriksaan → jumlah_satuan_barang, satuan_barang] --}}
            <td colspan="2" style="text-align: center;">
                {{ $penomoran->uraianBarang?->jumlahJenisSatuan }}
            </td>
            {{-- [tabel: uraian_barang → np] --}}
            <td colspan="2" class="right" style="text-align: center;">
                {{ $penomoran->uraianBarang?->np ?? '-' }} 
            </td>
            {{-- [tabel: uraian_barang → pos_tarif_hs] --}}
            <td style="text-align: center;">{{ $penomoran->uraianBarang?->pos_tarif_hs ?? '-' }}</td>
        </tr>

        {{-- 28 NDPBM + TTD Pemeriksa  ||  29–35 Pajak --}}
        <tr>
            {{-- Kiri: [tabel: uraian_barang → ndpbm, kota_pibk] + [tabel: pemeriksa → nama_pemeriksa, nip_pemeriksa] --}}
            <td colspan="5" style="padding:0; vertical-align:top;">
                <table class="inner">
                    <tr>
                        <td style="border-bottom:1px solid #000; padding:2px 4px;">
                            <span class="label">28. NDPBM :</span>
                            {{ $penomoran->uraianBarang?->ndpbm !== null ? $penomoran->uraianBarang->formatDecimal($penomoran->uraianBarang->ndpbm) : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center; padding:4px 2px;">
                            {{ $penomoran->display_kota_pibk }},
                            {{-- [tabel: pemeriksaan → tanggal] fallback ke penomoran → tanggal_pibk --}}
                            {{ $penomoran->pemeriksaan?->tanggal
                                ? \Carbon\Carbon::parse($penomoran->pemeriksaan->tanggal)->translatedFormat('d F Y')
                                : ($penomoran->tanggal_pibk ? \Carbon\Carbon::parse($penomoran->tanggal_pibk)->translatedFormat('d F Y') : '-') }}
                            <br>Pejabat Bea dan Cukai
                            <br><br><br>
                            {{ $penomoran->pemeriksa?->nama_pemeriksa ?? '' }}
                            <br>NIP {{ $penomoran->pemeriksa?->nip_pemeriksa ?? '' }}
                        </td>
                    </tr>
                </table>
            </td>

            {{-- Kanan: [tabel: uraian_barang → dalam_rupiah, bm, cukai, ppn, ppnbm, pph, total] --}}
            <td colspan="5" style="padding:0; vertical-align:top;">
                <table class="inner">
                    <tr>
                        <td style="border-bottom:1px solid #000; font-weight:bold; padding:2px 4px; width:60%;">29. Dalam Rupiah</td>
                        <td style="border-bottom:1px solid #000; text-align:right; padding:2px 4px;">
                            {{ $penomoran->uraianBarang?->dalam_rupiah !== null ? $penomoran->uraianBarang->formatDecimal($penomoran->uraianBarang->dalam_rupiah) : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold; padding:2px 4px; border-bottom: 1px solid black;">30. BM</td>
                        <td style="text-align:right; padding:2px 4px; border-bottom: 1px solid black;">
                            {{ $penomoran->uraianBarang?->bm !== null ? $penomoran->uraianBarang->formatDecimal($penomoran->uraianBarang->bm) : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold; padding:2px 4px; border-bottom: 1px solid black;">31. Cukai</td>
                        <td style="text-align:right; padding:2px 4px; border-bottom: 1px solid black;">
                            {{ $penomoran->uraianBarang?->cukai !== null ? $penomoran->uraianBarang->formatDecimal($penomoran->uraianBarang->cukai) : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold; padding:2px 4px; border-bottom: 1px solid black;">32. PPN</td>
                        <td style="text-align:right; padding:2px 4px; border-bottom: 1px solid black;">
                            {{ $penomoran->uraianBarang?->ppn !== null ? $penomoran->uraianBarang->formatDecimal($penomoran->uraianBarang->ppn) : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold; padding:2px 4px; border-bottom: 1px solid black;">33. PPnBM</td>
                        <td style="text-align:right; padding:2px 4px; border-bottom: 1px solid black;">
                            {{ $penomoran->uraianBarang?->ppnbm !== null ? $penomoran->uraianBarang->formatDecimal($penomoran->uraianBarang->ppnbm) : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold; padding:2px 4px; border-bottom: 1px solid black;">34. PPh</td>
                        <td style="text-align:right; padding:2px 4px; border-bottom: 1px solid black;">
                            {{ $penomoran->uraianBarang?->pph !== null ? $penomoran->uraianBarang->formatDecimal($penomoran->uraianBarang->pph) : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold; padding:2px 4px; border-bottom: 1px solid black;">35. Total</td>
                        <td style="text-align:right; padding:2px 4px; border-bottom: 1px solid black;">
                            {{ $penomoran->uraianBarang?->total !== null ? $penomoran->uraianBarang->formatDecimal($penomoran->uraianBarang->total) : '-' }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    {{-- ══ F & G ══ --}}
    <table class="main" style="margin-top:-1px;">
        <tr>
            <td colspan="5" class="section-header" style="width:55%;">F. UNTUK PEJABAT BEA DAN CUKAI</td>
            <td colspan="5" class="section-header" style="width:45%;">G. UNTUK PEMBAYARAN / JAMINAN</td>
        </tr>
        <tr>
            <td colspan="5" rowspan="7" style="vertical-align:bottom; text-align:center; padding-bottom: 10px;">
                {{ $penomoran->pfpd?->nama_pfpd ?? '' }}<br>
                NIP {{ $penomoran->pfpd?->nip_pfpd ?? '' }}
            </td>
            
            <td colspan="2">a.Pembayaran</td>
            <td colspan="3">1. Bank; &nbsp; 2. Pos; &nbsp; 3. Kantor Pabean.</td>
        </tr>
        <tr>
            <td colspan="2">b.Jaminan</td>
            <td colspan="3">1.Tunai &nbsp; 2.Bank Garansi &nbsp; 3.Customs Bond &nbsp; 4.Lainnya</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
            <td colspan="2" class="center label">Nomor</td>
            <td class="center label">Tanggal</td>
        </tr>
        <tr>
            <td colspan="2">Pembayaran</td>
            <td colspan="2" class="center">{{ $penomoran->jaminan?->pembayaran ?? '-' }}</td>
            <td class="center">-</td>
        </tr>
        <tr>
            <td colspan="2">Jaminan</td>
            <td colspan="2" class="center">{{ $penomoran->jaminan?->jaminan ?? '-' }}</td>
            <td class="center">-</td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight:bold; text-align:center;">Pejabat Penerima</td>
            <td colspan="2" style="font-weight:bold; text-align:center;">Stempel Instansi</td>
        </tr>
        <tr>
            <td colspan="3" style="height:60px; vertical-align:bottom; text-align:center;">ttd</td>
            <td colspan="2" style="vertical-align:bottom; text-align:center;">ttd</td>
        </tr>
    </table>

</div>
</body>
</html>