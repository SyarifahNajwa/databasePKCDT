{{--
    CETAK SPPB - SURAT PERSETUJUAN PENGELUARAN BARANG
    ══════════════════════════════════════════════════════════════
    VARIABEL YANG DIBUTUHKAN DI CONTROLLER:
      $penomoran → model Penomoran dengan relasi berikut:

    Relasi di model Penomoran:
      - penerima()     → hasOne(Penerima::class,    'penomoran_id')
      - pengangkutan() → hasOne(Pengangkutan::class, 'penomoran_id')
      - pib()          → hasOne(Pib::class,          'penomoran_id')
      - uraianBarang() → hasOne(UraianBarang::class, 'penomoran_id')
      - pemeriksaan()  → hasOne(Pemeriksaan::class,  'penomoran_id')
      - pemeriksa()    → hasOne(Pemeriksa::class,    'penomoran_id')
      - pfpd()         → hasOne(Pfpd::class,         'penomoran_id')

    Contoh controller:
      $penomoran = Penomoran::with([
          'penerima', 'pengangkutan', 'pib',
          'uraianBarang', 'pemeriksaan', 'pemeriksa', 'pfpd'
      ])->findOrFail($id);
      return view('cetak_sppb', compact('penomoran'));

    MAPPING VLOOKUP EXCEL → TABEL.KOLOM DATABASE:
      index  1  → penomoran.penomoran           (Penomoran)
      index  2  → penomoran.penomoran           (Default No PIBK - suffix)
      index  4  → penomoran.penomoran           (Default No SPPB - suffix)
      index  6  → penomoran.tanggal_pibk        (Tanggal PIBK)
      index 10  → penerima.identitas_penerima   (Identitas Penerima)
      index 11  → penerima.nama_penerima        (Nama Penerima)
      index 12  → penerima.alamat_penerima      (Alamat Penerima)
      index 20  → pengangkutan.no_flight        (No Voy/Flight)
      index 23  → pib.nomor_bc11                (Nomor BC 1.1)
      index 24  → pib.tanggal_bc11              (Tanggal BC 1.1)
      index 30  → pib.negara_asal_barang        (Negara Asal Barang)
      index 36  → uraian_barang.uraian_barang   (Uraian Barang)
      index 37  → uraian_barang.jumlah_kemasan  (Jumlah Kemasan)
      index 40  → uraian_barang.kota_pibk       (Kota PIBK)
      index 54  → pfpd.nama_pfpd               (Nama PFPD)
      index 55  → pfpd.nip_pfpd                (NIP PFPD)
      index 56  → pemeriksa.nama_pemeriksa     (Nama Pemeriksa)
      index 57  → pemeriksa.nip_pemeriksa      (NIP Pemeriksa)
      index 64  → pemeriksaan.catatan          (Catatan)
--}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SPPB - {{ $penomoran->formatted_penomoran ?? '' }}</title>
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
            padding: 15mm 20mm;
        }

        @media print {
            body { margin: 0; }
            .page { width: 100%; padding: 10mm 15mm; margin: 0; }
        }

        /* ── Kop Surat ── */
        .kop {
            text-align: center;
            margin-bottom: 6px;
            line-height: 1.6;
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
            font-size: 13pt;
            margin: 10px 0 2px 0;
        }

        .sub-judul {
            text-align: center;
            font-size: 10pt;
            margin-bottom: 16px;
        }

        /* ── Field rows ── */
        .field-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        .field-table td {
            padding: 2px 0;
            vertical-align: top;
            font-size: 10pt;
        }

        /* Lebar kolom label, titik dua, nilai */
        .col-label { width: 38%; }
        .col-titik  { width: 1%; text-align: left; }
        .col-value  { width: 65%; }

        /* ── Section title ── */
        .section-title {
            font-weight: bold;
            font-size: 10pt;
            margin: 10px 0 3px 0;
            /* text-decoration: underline; */
        }

        /* ── Tanda tangan dua kolom ── */
        .ttd-wrapper {
            margin-top: 24px;
            width: 100%;
            display: table;
        }

        .ttd-col {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            text-align: center;
        }

        .ttd-col .ttd-kota {
            font-size: 10pt;
            margin-bottom: 4px;
        }

        .ttd-col .ttd-jabatan {
            font-size: 10pt;
            margin-bottom: 60px; /* ruang tanda tangan */
        }

        .ttd-col .ttd-nama {
            font-weight: bold;
            font-size: 10pt;
        }

        .ttd-col .ttd-nip {
            font-size: 10pt;
        }

        /* ── Bagian tanda tangan kanan pakai tabel inline ── */
        .ttd-left-table {
            width: 80%;
            border-collapse: collapse;
            text-align: left;
        }
        .ttd-left-table td {
            padding: 2px 0;
            font-size: 10pt;
            vertical-align: top;
        }
        .ttd-left-table .col-l { width: 40%; }
        .ttd-left-table .col-t { width: 2%; text-align: left; }
        .ttd-left-table .col-v { width: 68%; white-space: nowrap; }
        
        .ttd-right-table {
            width: 80%;
            border-collapse: collapse;
            text-align: left;
        }

        .ttd-right-table td {
            padding: 2px 0;
            font-size: 10pt;
            vertical-align: top;
        }

        .ttd-right-table .col-l { width: 40%; }
        .ttd-right-table .col-t { width: 2%; text-align: left; }
        .ttd-right-table .col-v { width: 68%; white-space: nowrap; }
    </style>
</head>
<body>
<div class="page">

    {{-- ══════════════════════════════════════════
         KOP SURAT
    ══════════════════════════════════════════ --}}
    <div class="kop">
        <p>KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</p>
        <p>DIREKTORAT JENDERAL BEA DAN CUKAI</p>
        <p>KANTOR WILAYAH DJBC ACEH</p>
        <p>KANTOR PENGAWASAN DAN PELAYANAN BEA DAN CUKAI TIPE MADYA PABEAN C BANDA ACEH</p>
    </div>
    <hr class="divider-thick">

    {{-- ══════════════════════════════════════════
         JUDUL
    ══════════════════════════════════════════ --}}
    <div class="judul">SURAT PERSETUJUAN PENGELUARAN BARANG (SPPB)</div>
    <div class="sub-judul">BARANG IMPOR BAWAAN PENUMPANG/AWAK SARANA PENGANGKUT</div>

    {{-- ══════════════════════════════════════════
         NOMOR & DOKUMEN
         A9  : Nomor SPPB  → index 1 (penomoran.penomoran)
                             + index 4 (Default No SPPB, suffix)
         A10 : Tanggal     → index 6 (penomoran.tanggal_pibk)
         A11 : Dokumen     → statis 'PIBK'
         A12 : Nomor PIBK  → index 1 (penomoran.penomoran)
                             + index 2 (Default No PIBK, suffix)
    ══════════════════════════════════════════ --}}
    <table class="field-table">
        <tr>
            <td class="col-label">Nomor</td>
            <td class="col-titik">:</td>
            <td class="col-value">
                {{-- index 1 & 4 → penomoran.penomoran + suffix SPPB --}}
                {{ $penomoran->formatted_penomoran ?? '-' }}/SPPB/PIBK/RH/{{ $penomoran->tanggal_pibk ? \Carbon\Carbon::parse($penomoran->tanggal_pibk)->format('Y') : date('Y') }}
            </td>
        </tr>
        <tr>
            <td class="col-label">Tanggal</td>
            <td class="col-titik">:</td>
            <td class="col-value">
                {{-- index 6 → penomoran.tanggal_pibk --}}
                {{ $penomoran->tanggal_pibk ? \Carbon\Carbon::parse($penomoran->tanggal_pibk)->translatedFormat('d F Y') : '-' }}
            </td>
        </tr>
        <tr>
            <td class="col-label">Dokumen</td>
            <td class="col-titik">:</td>
            <td class="col-value">PIBK</td>
        </tr>
        <tr>
            <td class="col-label">Nomor</td>
            <td class="col-titik">:</td>
            <td class="col-value">
                {{-- index 1 & 2 → penomoran.penomoran + suffix PIBK --}}
                {{ $penomoran->formatted_penomoran ?? '-' }}/PIBK/RH/{{ $penomoran->tanggal_pibk ? \Carbon\Carbon::parse($penomoran->tanggal_pibk)->format('Y') : date('Y') }}
            </td>
        </tr>
    </table>

    {{-- ══════════════════════════════════════════
         PEMILIK BARANG
         A14: Nama      → index 11 → penerima.nama_penerima
         A15: Identitas → index 10 → penerima.identitas_penerima
         A16: NPWP      → statis '-'
         A17: Alamat    → index 12 → penerima.alamat_penerima
    ══════════════════════════════════════════ --}}
    <div class="section-title">Pemilik Barang</div>
    <table class="field-table">
        <tr>
            <td class="col-label">Nama</td>
            <td class="col-titik">:</td>
            <td class="col-value">{{ $penomoran->penerima?->nama_penerima ?? '-' }}</td>
        </tr>
        <tr>
            <td class="col-label">Identitas</td>
            <td class="col-titik">:</td>
            <td class="col-value">{{ $penomoran->penerima?->identitas_penerima ?? '-' }}</td>
        </tr>
        <tr>
            <td class="col-label">NPWP</td>
            <td class="col-titik">:</td>
            <td class="col-value">-</td>
        </tr>
        <tr>
            <td class="col-label">Alamat</td>
            <td class="col-titik">:</td>
            <td class="col-value">{{ $penomoran->penerima?->alamat_penerima ?? '-' }}</td>
        </tr>
    </table>

    {{-- ══════════════════════════════════════════
         PPJK/KUASA (statis '-' di Excel)
    ══════════════════════════════════════════ --}}
    <div class="section-title">PPJK/Kuasa</div>
    <table class="field-table">
        <tr>
            <td class="col-label">Nama</td>
            <td class="col-titik">:</td>
            <td class="col-value">-</td>
        </tr>
        <tr>
            <td class="col-label">NPWP</td>
            <td class="col-titik">:</td>
            <td class="col-value">-</td>
        </tr>
        <tr>
            <td class="col-label">Alamat</td>
            <td class="col-titik">:</td>
            <td class="col-value">-</td>
        </tr>
    </table>

    {{-- ══════════════════════════════════════════
         DETAIL BARANG
         A23: Lokasi Barang  → statis
         A24: No. Voy/Flight → index 20 → pengangkutan.no_flight
         A25: Negara Asal    → index 30 → pib.negara_asal_barang
         A26: No. BC 1.1     → index 23 → pib.nomor_bc11
         A27: Tgl BC 1.1     → index 24 → pib.tanggal_bc11
         A28: Jumlah         → index 37 → uraian_barang.jumlah_kemasan + satuan_kemasan
         A29: Uraian Barang  → index 36 → uraian_barang.uraian_barang
         A30: Catatan        → index 64 → pemeriksaan.catatan
    ══════════════════════════════════════════ --}}
    <table class="field-table" style="margin-top: 10px;">
        <tr>
            <td class="col-label">Lokasi Barang</td>
            <td class="col-titik">:</td>
            <td class="col-value">Kargo Bandara Sultan Iskandar Muda</td>
        </tr>
        <tr>
            <td class="col-label">No. Voy/Flight</td>
            <td class="col-titik">:</td>
            <td class="col-value">
                {{-- index 20 → pengangkutan.no_flight --}}
                {{ $penomoran->pengangkutan?->no_flight ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="col-label">Negara Asal</td>
            <td class="col-titik">:</td>
            <td class="col-value">
                {{-- index 30 → pib.negara_asal_barang --}}
                {{ $penomoran->pib?->negara_asal_barang ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="col-label">No. BC 1.1</td>
            <td class="col-titik">:</td>
            <td class="col-value">
                {{-- index 23 → pib.nomor_bc11 --}}
                {{ $penomoran->pib?->nomor_bc11 ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="col-label">Tgl BC 1.1.</td>
            <td class="col-titik">:</td>
            <td class="col-value">
                {{-- index 24 → pib.tanggal_bc11 --}}
                {{ $penomoran->pib?->tanggal_bc11 ? \Carbon\Carbon::parse($penomoran->pib->tanggal_bc11)->translatedFormat('d F Y') : '-' }}
            </td>
        </tr>
        <tr>
            <td class="col-label">Jumlah</td>
            <td class="col-titik">:</td>
            <td class="col-value">
                {{-- index 37 → uraian_barang.jumlah_kemasan + satuan_kemasan --}}
                {{ $penomoran->uraianBarang?->jumlahKemasanString }}
            </td>
        </tr>
        <tr>
            <td class="col-label">Uraian Barang</td>
            <td class="col-titik">:</td>
            <td class="col-value">
                {{-- index 36 → uraian_barang.uraian_barang --}}
                {{ $penomoran->uraianBarang?->uraian_barang ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="col-label">Catatan</td>
            <td class="col-titik">:</td>
            <td class="col-value">
                {{-- index 64 → pemeriksaan.catatan --}}
                {{ $penomoran->pemeriksaan?->catatan ?? '-' }}
            </td>
        </tr>
    </table>

    {{-- ══════════════════════════════════════════
         TANDA TANGAN (2 kolom)
         Kiri  (A35): Pejabat Pemeriksa Barang
                      → index 56 (pemeriksa.nama_pemeriksa)
                      → index 57 (pemeriksa.nip_pemeriksa)
         Kanan (H35): Pejabat Pemeriksa Dokumen
                      → index 54 (pfpd.nama_pfpd)
                      → index 55 (pfpd.nip_pfpd)

         Baris kota & tanggal (A34 & H34):
                      → index 40 (uraian_barang.kota_pibk)
                      → index  6 (penomoran.tanggal_pibk)
    ══════════════════════════════════════════ --}}
    <div class="ttd-wrapper">

        {{-- Kolom kiri: Pejabat Pemeriksa Barang --}}
        <div class="ttd-col">
            <div class="ttd-kota" style="text-align: left;">
                {{-- index 40 → uraian_barang.kota_pibk, index 6 → penomoran.tanggal_pibk --}}
                {{ $penomoran->display_kota_pibk }},
                {{ $penomoran->tanggal_pibk ? \Carbon\Carbon::parse($penomoran->tanggal_pibk)->translatedFormat('d F Y') : '-' }}
            </div>
            <div class="ttd-jabatan" style="text-align: left;">
                Pejabat Pemeriksa Barang
            </div>

            <table class="ttd-left-table">
                <tr style="text-align: left;">
                    <td class="col-l">Tanda tangan</td>
                    <td class="col-t">:</td>
                    <td class="col-v"></td>
                </tr>
                <tr style="text-align: left;">
                    <td class="col-l">Nama</td>
                    <td class="col-t">:</td>
                    {{-- index 54 → pfpd.nama_pemeriksa --}}
                    <td class="col-v">{{ $penomoran->pemeriksa?->nama_pemeriksa ?? '' }}</td>
                </tr>
                <tr style="text-align: left;">
                    <td class="col-l">NIP</td>
                    <td class="col-t">:</td>
                    {{-- index 55 → pfpd.nip_pemeriksa --}}
                    <td class="col-v">{{ $penomoran->pemeriksa?->nip_pemeriksa ?? '' }}</td>
                </tr>
            </table>
        </div>

        {{-- Kolom kanan: Pejabat Pemeriksa Dokumen --}}
        <div class="ttd-col">
            <div class="ttd-kota" style="text-align: left;">
                {{-- index 40 → uraian_barang.kota_pibk, index 6 → penomoran.tanggal_pibk --}}
                {{ $penomoran->display_kota_pibk }},
                {{ $penomoran->tanggal_pibk ? \Carbon\Carbon::parse($penomoran->tanggal_pibk)->translatedFormat('d F Y') : '-' }}
            </div>
            <div class="ttd-jabatan" style="text-align: left;">
                Pejabat Pemeriksa Dokumen
            </div>

            {{-- Tanda tangan + Nama + NIP dalam format field --}}
            <table class="ttd-right-table">
                <tr style="text-align: left;">
                    <td class="col-l">Tanda tangan</td>
                    <td class="col-t">:</td>
                    <td class="col-v"></td>
                </tr>
                <tr style="text-align: left;">
                    <td class="col-l">Nama</td>
                    <td class="col-t">:</td>
                    {{-- index 54 → pfpd.nama_pfpd --}}
                    <td class="col-v">{{ $penomoran->pfpd?->nama_pfpd ?? '-' }}</td>
                </tr>
                <tr style="text-align: left;">
                    <td class="col-l">NIP</td>
                    <td class="col-t">:</td>
                    {{-- index 55 → pfpd.nip_pfpd --}}
                    <td class="col-v">{{ $penomoran->pfpd?->nip_pfpd ?? '-' }}</td>
                </tr>
            </table>
        </div>

    </div>

</div>
</body>
</html>