{{--
    LAPORAN HASIL PEMERIKSAAN (LHP IP)
    ══════════════════════════════════════════════════════════════
    VARIABEL YANG DIBUTUHKAN DI CONTROLLER:
      $penomoran → model Penomoran dengan relasi:
        - pib()          → hasOne(Pib::class,          'penomoran_id')
        - uraianBarang() → hasOne(UraianBarang::class, 'penomoran_id')
        - pemeriksaan()  → hasOne(Pemeriksaan::class,  'penomoran_id')
        - pemeriksa()    → hasOne(Pemeriksa::class,    'penomoran_id')

    Contoh controller:
      $penomoran = Penomoran::with([
          'pib', 'uraianBarang', 'pemeriksaan', 'pemeriksa'
      ])->findOrFail($id);
      return view('lhp_ip', compact('penomoran'));

    MAPPING VLOOKUP EXCEL → TABEL.KOLOM DATABASE:
      index  1  → penomoran.penomoran
      index  2  → penomoran.penomoran        (suffix PIBK)
      index  4  → penomoran.penomoran        (suffix LHP)
      index  6  → penomoran.tanggal_pibk
      index 28  → pib.nomor_bl_awb           (Nomor BL/AWB)
      index 29  → pib.tanggal_bl_awb         (Tanggal BL/AWB)
      index 30  → pib.negara_asal_barang     (Negara Asal Barang)
      index 36  → uraian_barang.uraian_barang
      index 37  → uraian_barang.jumlah_kemasan
      index 38  → uraian_barang.berat        (Berat/Satuan)
      index 40  → uraian_barang.kota_pibk
      index 52  → pemeriksaan.hari
      index 53  → pemeriksaan.tanggal
      index 56  → pemeriksa.nama_pemeriksa
      index 62  → pemeriksaan.contoh
      index 63  → pemeriksaan.foto
      index 65  → pemeriksaan.jam_mulai_periksa
      index 66  → pemeriksaan.jam_selesai_periksa
      index 67  → pemeriksaan.lokasi_pemeriksaan
      index 68  → pemeriksaan.kondisi_segel
      index 69  → pemeriksaan.jumlah_satuan_barang
      index 70  → pemeriksaan.jenis_kemasan
      index 71  → pemeriksaan.ukuran_kemasan
      index 72  → pemeriksaan.spesifikasi
      index 73  → pemeriksaan.keterangan
--}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>LHP IP - {{ $penomoran->formatted_penomoran ?? '' }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            background: #fff;
            color: #000;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            padding: 12mm 18mm;
        }

        @media print {
            body { margin: 0; }
            .page { width: 100%; padding: 8mm 12mm; margin: 0; }
        }

        /* ── Kop ── */
        .kop {
            text-align: center;
            line-height: 1.6;
            font-size: 10pt;
        }
        .kop .bold { font-weight: bold; }

        .divider-thick {
            border: none;
            border-top: 3px solid #000;
            margin: 5px 0 10px 0;
        }

        /* ── Judul ── */
        .judul {
            text-align: center;
            font-weight: bold;
            font-size: 12pt;
            margin: 10px 0 2px 0;
        }
        .sub-judul {
            text-align: center;
            font-weight: bold;
            font-size: 10pt;
            margin-bottom: 14px;
        }

        /* ── Field rows (2 kolom kiri-kanan pakai tabel) ── */
        .field-table {
            width: 100%;
            border-collapse: collapse;
        }
        .field-table td {
            padding: 2px 0;
            vertical-align: top;
            font-size: 10pt;
        }

        /* Kolom kiri (label) dan kanan (nilai) dari 2 blok field sejajar */
        .lbl-left  { width: 22%; }
        .titik     { width: 3%; text-align: left; }
        .val-left  { width: 25%; }
        .gap       { width: 5%; }
        .lbl-right { width: 22%; }
        .titik2    { width: 3%; text-align: left; }
        .val-right { width: 20%; }

        /* Untuk field full-width (nomor, tanggal, dokumen, dll) */
        .lbl-full  { width: 25%; }
        .titik-full{ width: 3%; text-align: left; }
        .val-full  { width: 72%; }

        /* ── Section title ── */
        .section-title {
            font-weight: bold;
            font-size: 10pt;
            margin: 10px 0 3px 0;
        }

        /* ── Tabel Hasil Pemeriksaan ── */
        table.hasil {
            width: 100%;
            border-collapse: collapse;
            margin-top: 4px;
            font-size: 9.5pt;
        }
        table.hasil th, table.hasil td {
            border: 1px solid #000;
            padding: 3px 4px;
            vertical-align: top;
            text-align: left;
        }
        table.hasil th {
            font-weight: bold;
            text-align: center;
            background-color: #f0f0f0;
        }

        /* ── Tanda tangan ── */
        .ttd-area {
            margin-top: 20px;
        }
        .ttd-kota {
            font-size: 10pt;
            margin-bottom: 4px;
        }
        .ttd-jabatan {
            font-size: 10pt;
            margin-bottom: 55px;
        }
        .ttd-nama {
            font-weight: bold;
            font-size: 10pt;
        }
        .ttd-nip {
            font-size: 10pt;
        }
    </style>
</head>
<body>
<div class="page">

    {{-- ══ KOP SURAT ══ --}}
    <div class="kop">
        <p>KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</p>
        <p>DIREKTORAT JENDERAL BEA DAN CUKAI</p>
        <p>KANTOR WILAYAH DJBC ACEH</p>
        <p>KANTOR PENGAWASAN DAN PELAYANAN BEA DAN CUKAI TIPE MADYA PABEAN C BANDA ACEH</p>
    </div>
    <hr class="divider-thick">

    {{-- ══ JUDUL ══ --}}
    <div class="judul">LAPORAN HASIL PEMERIKSAAN</div>
    <div class="sub-judul">BARANG IMPOR BAWAAN PENUMPANG/AWAK SARANA PENGANGKUT</div>

    {{-- ══ GRUP 1: Nomor, Tanggal, Dokumen, Nomor → label pendek ══ --}}
    <table class="field-table">
        <tr>
            <td style="width:15%;">Nomor</td>
            <td style="width:2%;">:</td>
            <td style="width:82%;">
                {{-- index 1 & 4 → penomoran.penomoran + suffix LHP --}}
                {{ $penomoran->formatted_penomoran ?? '-' }}/SPPB/PIBK/RH/{{ $penomoran->tanggal_pibk ? \Carbon\Carbon::parse($penomoran->tanggal_pibk)->format('Y') : date('Y') }}
            </td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td>
                {{-- index 6 → penomoran.tanggal_pibk --}}
                {{ $penomoran->tanggal_pibk ? \Carbon\Carbon::parse($penomoran->tanggal_pibk)->translatedFormat('d F Y') : '-' }}
            </td>
        </tr>
        <tr>
            <td>Dokumen</td>
            <td>:</td>
            <td>PIBK</td>
        </tr>
        <tr>
            <td>Nomor</td>
            <td>:</td>
            <td>
                {{-- index 1 & 2 → penomoran.penomoran + suffix PIBK --}}
                {{ $penomoran->formatted_penomoran ?? '-' }}/PIBK/RH/{{ $penomoran->tanggal_pibk ? \Carbon\Carbon::parse($penomoran->tanggal_pibk)->format('Y') : date('Y') }}
            </td>
        </tr>
    </table>

    {{-- ══ GRUP 2: Hari/tanggal s/d Jumlah dan jenis barang → label lebih lebar ══ --}}
    <table class="field-table">
        <tr>
            <td style="width:35%;">Hari/tanggal</td>
            <td style="width:2%;">:</td>
            <td style="width:55%;">
                {{-- index 52 → pemeriksaan.hari, index 53 → pemeriksaan.tanggal --}}
                {{ $penomoran->pemeriksaan?->hari ?? '-' }} /
                {{ $penomoran->pemeriksaan?->tanggal ? \Carbon\Carbon::parse($penomoran->pemeriksaan->tanggal)->translatedFormat('d F Y') : '-' }}
            </td>
        </tr>
        <tr>
            <td>Jam mulai periksa</td>
            <td>:</td>
            <td>
                {{-- index 65 → pemeriksaan.jam_mulai_periksa --}}
                {{ $penomoran->pemeriksaan?->jam_mulai_periksa ? \Carbon\Carbon::parse($penomoran->pemeriksaan->jam_mulai_periksa)->format('H.i') . ' WIB' : '-' }}
            </td>
        </tr>
        <tr>
            <td>Jam selesai periksa</td>
            <td>:</td>
            <td>
                {{-- index 66 → pemeriksaan.jam_selesai_periksa --}}
                {{ $penomoran->pemeriksaan?->jam_selesai_periksa ? \Carbon\Carbon::parse($penomoran->pemeriksaan->jam_selesai_periksa)->format('H.i') . ' WIB' : '-' }}
            </td>
        </tr>
        <tr>
            <td>Lokasi</td>
            <td>:</td>
            <td>
                {{-- index 67 → pemeriksaan.lokasi_pemeriksaan --}}
                {{ $penomoran->pemeriksaan?->lokasi_pemeriksaan ?? '-' }}
            </td>
        </tr>
        <tr>
            <td>Jumlah Kemasan yang diperiksa</td>
            <td>:</td>
            <td>
                {{-- index 37 → uraian_barang.jumlah_kemasan, index 38 → uraian_barang.berat --}}
                {{ $penomoran->uraianBarang?->jumlahJenisSatuan }}
            </td>
        </tr>
        <tr>
            <td>Kondisi segel</td>
            <td>:</td>
            <td>
                {{-- index 68 → pemeriksaan.kondisi_segel --}}
                {{ $penomoran->pemeriksaan?->kondisi_segel ?? '-' }}
            </td>
        </tr>
        <tr>
            <td>Jumlah dan jenis barang yang diperiksa</td>
            <td>:</td>
            <td>
                {{-- index 69 → pemeriksaan.jumlah_satuan_barang, index 36 → uraian_barang.uraian_barang --}}
                {{ $penomoran->pemeriksaan?->jumlah_satuan_barang ?? '-' }} {{ $penomoran->pemeriksaan?->satuan_barang ?? '-' }}, 
                {{ $penomoran->uraianBarang?->uraian_barang ?? '-' }}
            </td>
        </tr>
    </table>

    {{-- ══ TABEL HASIL PEMERIKSAAN (A21–J23) ══ --}}
    <div class="section-title" style="margin-top: 12px; font-weight: normal;">Hasil Pemeriksaan</div>
    <table class="hasil" style="text-align: center;">
        <thead>
            <tr >
                <th style="width:4%; vertical-align: middle;">No.</th>
                <th style="width:18%; vertical-align: middle;">Jumlah, Jenis, Ukuran Kemasan</th>
                <th style="width:22%; vertical-align: middle;">Uraian Barang</th>
                <th style="width:12%; vertical-align: middle;">Jumlah satuan Barang</th>
                <th style="width:16%; vertical-align: middle;">Spesifikasi</th>
                <th style="width:12%; vertical-align: middle;">Negara Asal</th>
                <th style="width:16%; vertical-align: middle;">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align:center; vertical-align: middle;">1</td>
                <td style="text-align: center; vertical-align: middle;">
                    {{--
                        B23: index 37 (uraian_barang.jumlah_kemasan)
                           + index 70 (pemeriksaan.jenis_kemasan)
                           + index 71 (pemeriksaan.ukuran_kemasan)
                    --}}
                    {{ $penomoran->uraianBarang?->jumlah_kemasan ?? '-' }},
                    {{ $penomoran->pemeriksaan?->jenis_kemasan ?? '-' }},
                    {{ $penomoran->pemeriksaan?->ukuran_kemasan ?? '-' }}
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    {{--
                        E23: statis di Excel (keterangan X-Ray), tapi bisa diisi dari
                        uraian_barang.uraian_barang jika data dinamis
                    --}}
                    {{ $penomoran->pemeriksaan?->hasil_uraian_barang ?? '-' }}
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    {{-- G23: index 69 → pemeriksaan.jumlah_satuan_barang --}}
                    {{ $penomoran->pemeriksaan?->jumlah_satuan_barang ?? '-' }}
                    {{ $penomoran->pemeriksaan?->satuan_barang ?? '' }}
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    {{-- H23: index 72 → pemeriksaan.spesifikasi --}}
                    {{ $penomoran->pemeriksaan?->spesifikasi ?? '-' }}
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    {{-- I23: index 30 → pib.negara_asal_barang --}}
                    {{ $penomoran->pib?->negara_asal_barang ?? '-' }}
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    {{-- J23: index 73 → pemeriksaan.keterangan --}}
                    {{ $penomoran->pemeriksaan?->keterangan ?? '-' }}
                </td>
            </tr>
        </tbody>
    </table>

    {{-- ══ CONTOH & FOTO (A25) ══
         index 62 → pemeriksaan.contoh
         index 63 → pemeriksaan.foto
    ══ --}}
    <table class="field-table" style="margin-top: 10px;">
        <tr>
            <td style="width:13%;">Contoh</td>
            <td style="width:3%;">:</td>
            <td style="width:25%;">{{ $penomoran->pemeriksaan?->contoh ?? '-' }}</td>
            <td style="width:7%;">FOTO</td>
            <td style="width:3%;">:</td>
            <td>{{ $penomoran->pemeriksaan?->foto ?? '-' }}</td>
        </tr>
    </table>

    {{-- ══ KESIMPULAN (A26–A27) ══
         A27: "Jumlah dan jenis barang sesuai pemberitahuan AWB nomor [nomor_bl_awb] tanggal [tanggal_bl_awb]"
         index 28 → pib.nomor_bl_awb
         index 29 → pib.tanggal_bl_awb
    ══ --}}
    <table class="field-table" style="margin-top: 10px;">
    <tr>
        <td style="width:13%;">Kesimpulan</td>
        <td style="width:3%;">:</td>
        <td></td>
    </tr>
    </table>

    <table style="width:100%; margin-top: 5px; border-collapse: collapse;">
        <tr>
            <td style="border: 1px solid #000; padding: 8px 12px;">
                Jumlah dan jenis barang sesuai pemberitahuan AWB nomor
                {{-- index 28 → pib.nomor_bl_awb --}}
                {{ $penomoran->pib?->nomor_bl_awb ?? '-' }}
                tanggal
                {{-- index 29 → pib.tanggal_bl_awb --}}
                {{ $penomoran->pib?->tanggal_bl_awb ? \Carbon\Carbon::parse($penomoran->pib->tanggal_bl_awb)->translatedFormat('d F Y') : '-' }}
            </td>
        </tr>
    </table>

    {{-- ══ TANDA TANGAN (A31–A38) ══
         A31: kota & tanggal → uraian_barang.kota_pibk + penomoran.tanggal_pibk
         A32: jabatan        → statis "Pejabat Pemeriksa Barang"
         A37: Tanda tangan   → (ruang kosong)
         A38: Nama           → index 56 → pemeriksa.nama_pemeriksa
    ══ --}}
    <div class="ttd-area">
        <div class="ttd-kota">
            {{-- index 40 → uraian_barang.kota_pibk, index 6 → penomoran.tanggal_pibk --}}
            {{ $penomoran->display_kota_pibk }},
            {{ $penomoran->tanggal_pibk ? \Carbon\Carbon::parse($penomoran->tanggal_pibk)->translatedFormat('d F Y') : '-' }}
        </div>
        <div class="ttd-jabatan">Pejabat Pemeriksa Barang</div>

        <table class="field-table" style="width: 50%; margin-top: 80px;">
            <tr>
                <td style="width:30%;">Tanda tangan</td>
                <td style="width:5%;">:</td>
                <td style="width:65%;"></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>
                    {{-- index 56 → pemeriksa.nama_pemeriksa --}}
                    {{ $penomoran->pemeriksa?->nama_pemeriksa ?? '-' }}
                </td>
            </tr>
            <tr>
                <td>NIP</td>
                <td>:</td>
                <td>
                    {{-- pemeriksa.nip_pemeriksa (index 57) --}}
                    {{ $penomoran->pemeriksa?->nip_pemeriksa ?? '-' }}
                </td>
            </tr>
        </table>
    </div>

</div>
</body>
</html>