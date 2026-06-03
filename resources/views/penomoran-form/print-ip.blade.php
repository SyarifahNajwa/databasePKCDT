{{--
    CETAK IP - INSTRUKSI PEMERIKSAAN
    ══════════════════════════════════════════════════════════════
    VARIABEL YANG DIBUTUHKAN DI CONTROLLER:
      $penomoran → model Penomoran dengan relasi:
        - penerima()     → hasOne(Penerima::class)
        - uraianBarang() → hasOne(UraianBarang::class)
        - pemeriksaan()  → hasOne(Pemeriksaan::class)
        - pemeriksa()    → hasOne(Pemeriksa::class)
        - pfpd()         → hasOne(Pfpd::class)

    Contoh controller:
      $penomoran = Penomoran::with([
          'penerima', 'uraianBarang', 'pemeriksaan', 'pemeriksa', 'pfpd'
      ])->findOrFail($id);
      return view('cetak_ip', compact('penomoran'));

    MAPPING VLOOKUP → DATABASE:
      index  1  → penomoran.penomoran
      index  3  → penomoran.penomoran (Default No IP, suffix)
      index  6  → penomoran.tanggal_pibk
      index 10  → penerima.identitas_penerima
      index 11  → penerima.nama_penerima
      index 12  → penerima.alamat_penerima
      index 37  → uraian_barang.jumlah_kemasan
      index 40  → uraian_barang.kota_pibk
      index 54  → pfpd.nama_pfpd
      index 55  → pfpd.nip_pfpd
      index 56  → pemeriksa.nama_pemeriksa
      index 57  → pemeriksa.nip_pemeriksa
      index 62  → pemeriksaan.contoh
      index 63  → pemeriksaan.foto
--}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>IP - {{ $penomoran->formatted_penomoran ?? '' }}</title>
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
            margin-bottom: 10px;
        }
        .kop p { line-height: 1.5; font-size: 10pt; }
        .kop .instansi { font-weight: bold; font-size: 10pt; }

        .divider {
            border: none;
            border-top: 3px solid #000;
            margin: 4px 0 8px 0;
        }

        /* ── Judul ── */
        .judul {
            text-align: center;
            font-weight: bold;
            font-size: 13pt;
            margin: 10px 0 2px 0;
            text-decoration: underline;
        }

        .sub-judul {
            text-align: center;
            font-size: 10pt;
            margin-bottom: 14px;
        }

        /* ── Field rows ── */
        .field-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2px;
        }

        .field-table td {
            padding: 1px 0;
            vertical-align: top;
            font-size: 10pt;
        }

        .col-label  { width: 45%; }
        .col-titik  { width: 3%; text-align: center; }
        .col-value  { width: 52%; }

        /* ── Section header ── */
        .section-title {
            font-weight: bold;
            font-size: 10pt;
            margin: 8px 0 2px 0;
            text-decoration: underline;
        }

        /* ── Tingkat Pemeriksaan & bawahnya pakai 2 kolom ── */
        .field-table-wide .col-label { width: 55%; }
        .field-table-wide .col-titik { width: 3%; }
        .field-table-wide .col-value { width: 42%; }

        /* ── Area tanda tangan ── */
        .ttd-area {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .ttd-block {
            width: 45%;
            text-align: center;
        }

        .ttd-block .ttd-title {
            font-size: 10pt;
            margin-bottom: 50px;
        }

        .ttd-block .ttd-name {
            font-weight: bold;
            font-size: 10pt;
            border-top: 1px solid #000;
            padding-top: 2px;
        }

        .ttd-block .ttd-nip {
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
    <hr class="divider">

    {{-- ══ JUDUL ══ --}}
    <div class="judul">INSTRUKSI PEMERIKSAAN (IP)</div>
    <div class="sub-judul">BARANG IMPOR BAWAAN PENUMPANG/AWAK SARANA PENGANGKUT</div>

    {{-- ══ NOMOR & TANGGAL ══ --}}
    {{-- Nomor IP: VLOOKUP index 1 (penomoran.penomoran) + index 3 (Default No IP) --}}
    <table class="field-table">
        <tr>
            <td class="col-label">Nomor</td>
            <td class="col-titik">:</td>
            <td class="col-value">
                {{-- index 1 = penomoran.penomoran, index 3 = no IP (format: nopen + suffix IP) --}}
                {{ $penomoran->formatted_penomoran ?? '-' }}/IP/PIBK/RH/{{ $penomoran->tanggal_pibk ? \Carbon\Carbon::parse($penomoran->tanggal_pibk)->format('Y') : date('Y') }}
            </td>
        </tr>
        <tr>
            {{-- index 6 = penomoran.tanggal_pibk --}}
            <td class="col-label">Tanggal</td>
            <td class="col-titik">:</td>
            <td class="col-value">
                {{ $penomoran->tanggal_pibk ? \Carbon\Carbon::parse($penomoran->tanggal_pibk)->translatedFormat('d F Y') : '-' }}
            </td>
        </tr>
        <tr>
            <td class="col-label">Dokumen</td>
            <td class="col-titik">:</td>
            <td class="col-value">PIBK</td>
        </tr>
        <tr>
            {{-- Nomor PIBK: index 1 (penomoran) + index 2 (Default No PIBK suffix) --}}
            <td class="col-label">Nomor</td>
            <td class="col-titik">:</td>
            <td class="col-value">
                {{ $penomoran->formatted_penomoran ?? '-' }}/PIBK/RH/{{ $penomoran->tanggal_pibk ? \Carbon\Carbon::parse($penomoran->tanggal_pibk)->format('Y') : date('Y') }}
            </td>
        </tr>
    </table>

    {{-- ══ PEMILIK BARANG ══ --}}
    <div class="section-title">Pemilik Barang</div>
    <table class="field-table">
        <tr>
            {{-- index 11 = col 12 = penerima.nama_penerima --}}
            <td class="col-label">Nama</td>
            <td class="col-titik">:</td>
            <td class="col-value">{{ $penomoran->penerima?->nama_penerima ?? '-' }}</td>
        </tr>
        <tr>
            {{-- index 10 = col 11 = penerima.identitas_penerima --}}
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
            {{-- index 12 = col 13 = penerima.alamat_penerima --}}
            <td class="col-label">Alamat</td>
            <td class="col-titik">:</td>
            <td class="col-value">{{ $penomoran->penerima?->alamat_penerima ?? '-' }}</td>
        </tr>
    </table>

    {{-- ══ PPJK/KUASA ══ --}}
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

    {{-- ══ PEJABAT PEMERIKSA BARANG ══ --}}
    <div class="section-title">PEJABAT PEMERIKSA BARANG</div>
    <table class="field-table">
        <tr>
            {{-- index 56 = col 57 = pemeriksa.nama_pemeriksa --}}
            <td class="col-label">Nama</td>
            <td class="col-titik">:</td>
            <td class="col-value">{{ $penomoran->pemeriksa?->nama_pemeriksa ?? '-' }}</td>
        </tr>
        <tr>
            {{-- index 57 = col 58 = pemeriksa.nip_pemeriksa --}}
            <td class="col-label">NIP</td>
            <td class="col-titik">:</td>
            <td class="col-value">{{ $penomoran->pemeriksa?->nip_pemeriksa ?? '-' }}</td>
        </tr>
    

    {{-- ══ DETAIL PEMERIKSAAN ══ --}}
    
        <tr>
            <td class="col-label">Tingkat Pemeriksaan</td>
            <td class="col-titik">:</td>
            <td class="col-value">Mendalam</td>
        </tr>
        <tr>
            {{-- index 37 = col 38 = uraian_barang.jumlah_kemasan --}}
            <td class="col-label">Jumlah Kemasan yang diperiksa</td>
            <td class="col-titik">:</td>
            <td class="col-value">
                {{ $penomoran->uraianBarang?->jumlah_kemasan ?? '-' }}
                {{ $penomoran->uraianBarang?->satuan_kemasan ?? '' }}
            </td>
        </tr>
        <tr>
            <td class="col-label">Nomor Kemasan yang diperiksa</td>
            <td class="col-titik">:</td>
            <td class="col-value">-</td>
        </tr>
        <tr>
            {{-- index 62 = col 63 = pemeriksaan.contoh --}}
            <td class="col-label">Ajukan contoh (ya / tidak)</td>
            <td class="col-titik">:</td>
            <td class="col-value">{{ $penomoran->pemeriksaan?->contoh ?? '-' }}</td>
        </tr>
        <tr>
            {{-- index 63 = col 64 = pemeriksaan.foto --}}
            <td class="col-label">Ajukan foto (ya / tidak)</td>
            <td class="col-titik">:</td>
            <td class="col-value">{{ $penomoran->pemeriksaan?->foto ?? '-' }}</td>
        </tr>
    </table>

    {{-- ══ TANDA TANGAN ══ --}}
    {{-- Baris kota & tanggal: index 40 = uraian_barang.kota_pibk, index 6 = penomoran.tanggal_pibk --}}
    <div style="margin-top: 20px; text-align: left;">
        {{ $penomoran->uraianBarang?->kota_pibk ?? 'Banda Aceh' }},
        {{ $penomoran->tanggal_pibk ? \Carbon\Carbon::parse($penomoran->tanggal_pibk)->translatedFormat('d F Y') : '-' }}
        <div>Pejabat Pemeriksa Dokumen</div>
            <br><br><br><br>
    </div>

    <table style="width:100%; margin-top: 10px;">
        <tr>
            {{-- Kiri: Pejabat Pemeriksa Dokumen (PFPD) --}}
            {{-- index 54 = col 55 = pfpd.nama_pfpd, index 55 = col 56 = pfpd.nip_pfpd --}}
            <td style="width:50%; text-align:left; vertical-align:top;">
                <div style="font-weight:bold;">{{ $penomoran->pfpd?->nama_pfpd ?? '' }}</div>
                <div>{{ $penomoran->pfpd?->nip_pfpd ?? '' }}</div>
            </td>
    </table>

</div>
</body>
</html>