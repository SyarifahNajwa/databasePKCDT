<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak PIBK - {{ $penomoran->penomoran }}</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 10mm;
        }
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            font-size: 11pt;
            color: #000;
        }
        .no-print {
            display: block;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
        .action-buttons {
            text-align: center;
            margin: 16px 0;
        }
        .action-buttons button {
            cursor: pointer;
            border: 1px solid #444;
            background: #f4f4f4;
            color: #000;
            padding: 8px 14px;
            margin: 0 4px;
            border-radius: 4px;
            font-size: 10pt;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 10px;
        }
        .page-table td {
            border: none;
            padding: 0;
            vertical-align: top;
        }
        .section-table,
        .header-table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }
        .section-table th,
        .section-table td,
        .header-table td {
            border: 1px solid #000;
            padding: 6px 7px;
            vertical-align: top;
        }
        .section-table th {
            font-weight: bold;
            text-align: left;
            background: #f7f7f7;
        }
        .header-title {
            font-weight: bold;
            text-align: center;
            font-size: 13pt;
            margin: 0;
        }
        .header-note {
            font-size: 9pt;
            line-height: 1.2;
        }
        .label-cell {
            font-weight: bold;
            width: 35%;
        }
        .value-cell {
            min-height: 1.2em;
        }
        .signature-table td {
            padding: 18px 8px;
            text-align: center;
            border: 1px solid #000;
            min-height: 90px;
        }
        .signature-table td span {
            display: inline-block;
            margin-top: 50px;
            border-top: 1px solid #000;
            width: 100%;
        }
        .header-title {
            text-align: center;
            font-weight: bold;
            font-size: 14pt;
            margin-bottom: 4px;
        }
        .header-subtitle {
            text-align: center;
            font-size: 9pt;
            font-weight: bold;
            line-height: 1.3;
            margin: 0;
        }
        .subsection-title {
            font-weight: bold;
            font-size: 10pt;
            padding: 6px 0;
            margin: 10px 0 4px;
        }
        .field-label {
            font-weight: bold;
        }
        .value-cell {
            min-height: 1.2em;
        }
        .signature-table td {
            padding: 18px 8px;
            text-align: center;
            border: 1px solid #000;
            min-height: 90px;
        }
        .signature-table td span {
            display: inline-block;
            margin-top: 50px;
            border-top: 1px solid #000;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="action-buttons no-print">
        <button type="button" onclick="window.print();">Cetak</button>
        <button type="button" onclick="window.history.back();">Kembali</button>
    </div>

    <h3 colspan="2" class="header-title">Pemberitahuan Impor Barang Khusus (PIBK)</h3>
    <h4 class="header-note" style="text-align: center;">A. Untuk 1. Barang Pindahan Penumpang 2. Barang Kiriman Melalui PJT 3. Barang Impor Sementara Dibawa <br> 4. Barang Impor Tertentu 5. Barang Pribadi Penumpang 6. Lainnya</h4>
    

    <table class="page-table">
        <tr>
            <td style="width: 50%; padding-right: 4px;">
                <table class="section-table">
                    <tr>
                        <th colspan="2">B. DATA PEMBERITAHUAN</th>
                    </tr>
                    <tr>
                        <td class="field-label" colspan="2">
                            <span style="text-transform: uppercase; font-weight: bold;">1. Nama, Alamat Pengirim Barang</span>
                            <br>
                            <span style="text-transform: uppercase; font-weight: normal;">{{ $penomoran->pengirim->nama_pengirim ?? '-' }}<br>{{ $penomoran->pengirim->alamat_pengirim ?? '-' }}</span>
                            <br><br><br>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label" colspan="2">
                            <span style="text-transform: uppercase; font-weight: bold;">2. Identitas Pengirim Barang</span>
                            <br>
                            <span style="text-transform: uppercase; font-weight: normal;">{{ $penomoran->pengirim->jenis_identitas_pengirim ?? '-' }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label" colspan="2">
                            <span style="text-transform: uppercase; font-weight: bold;">3. Nama, Alamat Penerima Barang</span>
                            <br>
                            <span style="text-transform: uppercase; font-weight: normal;">{{ $penomoran->penerima->nama_penerima ?? '-' }}<br>{{ $penomoran->penerima->alamat_penerima ?? '-' }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label" colspan="2">
                            <span style="text-transform: uppercase; font-weight: bold;">4. Identitas Pemberitahu</span>
                            <br>
                            <span style="text-transform: uppercase; font-weight: normal;">{{ $penomoran->pemberitahu->identitas_pemberitahu ?? '-' }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label" colspan="2">
                            <span style="text-transform: uppercase; font-weight: bold;">5. Nama, Alamat Pemberitahu</span>
                            <br>
                            <span style="text-transform: uppercase; font-weight: normal;">{{ $penomoran->pemberitahu->nama_pemberitahu ?? '-' }}<br>{{ $penomoran->pemberitahu->alamat_pemberitahu ?? '-' }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label" colspan="2">
                            <span style="text-transform: uppercase; font-weight: bold;">6. No. & Tgl. Surat Izin PJT/PPJK</span>
                            <br>
                            <span style="text-transform: uppercase; font-weight: normal;">{{ $penomoran->suratIzin->nomor_surat_izin_pjt_ppjk ?? '-' }} <br> {{ $penomoran->suratIzin->tanggal_surat_izin_pjt_ppjk?->format('d-m-Y') ?? '-' }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label" colspan="2">
                            <span style="text-transform: uppercase; font-weight: bold;">7. Cara Pengangkutan</span>
                            <br>
                            <span style="text-transform: none; font-weight: normal;">{{ ucfirst($penomoran->pengangkutan->cara_pengangkutan ?? '-') }}</span>
                        </td>
                    </tr>                    
                        <td class="field-label" colspan="2">
                            <span style="text-transform: uppercase; font-weight: bold;">8. Nama Sarana Pengangkut & No. Voy/Flight</span>
                            <br>
                            <span style="text-transform: none; font-weight: normal;">{{ $penomoran->pengangkutan->nama_sarkut ?? '-' }} <br> {{ $penomoran->pengangkutan->no_flight ?? '-' }}</span>
                        </td>                    
                    <tr>
                        <td class="field-label" style="width: 50%;">
                            <span style="text-transform: uppercase; font-weight: bold;">9. Pelabuhan Muat</span>
                            <br>
                            <span style="text-transform: none; font-weight: normal;">{{ $penomoran->pengangkutan->pelabuhan_muat ?? '-' }}</span>
                        </td>
                        <td class="field-label" style="width: 50%;">
                            <span style="text-transform: uppercase; font-weight: bold;">10. Pelabuhan Bongkar</span>
                            <br>
                            <span style="text-transform: none; font-weight: normal;">{{ $penomoran->pengangkutan->pelabuhan_bongkar ?? '-' }}</span>
                        </td>
                </table>
            </td>
            <td style="width: 50%; padding-left: 0px; vertical-align: top;">
                <table class="section-table">
                    <tr>
                        <th colspan="4">D. DIISI OLEH BEA DAN CUKAI</th>
                    </tr>
                    <tr>
                        <td class="label-cell" >Nopen</td>
                        <td class="value-cell">{{ $penomoran->penomoran ?? '-' }}</td>
                        <td class="label-cell" colspan="2" >/PIBK/RH/2026	
</td>
                    </tr>
                    <tr>
                        <td class="label-cell">Tanggal Nopen</td>
                        <td class="value-cell" colspan="3">{{ $penomoran->tanggal_penomoran ? $penomoran->tanggal_penomoran->format('d-m-Y') : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label-cell">Kantor Pabean</td>
                        <td class="value-cell" colspan="3">130100</td>
                    </tr>
                    <tr>
                        <td class="label-cell">No. BC 1.1</td>
                        <td class="value-cell">{{ $penomoran->pib?->nomor_bc11 ?? '-' }}</td>
                        <td class="label-cell">Tgl</td>
                        <td class="value-cell" width="50%">{{ $penomoran->pib?->tanggal_bc11?->translatedFormat('d F Y') ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label" style="width: 50%" colspan="3">
                            <span style="text-transform: uppercase; font-weight: bold;">Pos </span>
                            <br>
                            <span style="text-transform: none; font-weight: normal;">{{ $penomoran->pib?->nomor_pos ?? '-' }}</span>
                        </td>
                        <td class="field-label" style="width: 50%;">
                            <span style="text-transform: uppercase; font-weight: bold;">Sub Pos</span>
                            <br>
                            <span style="text-transform: none; font-weight: normal;">{{ $penomoran->pib?->nomor_subpos ?? '-' }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label" style="width: 50%" colspan="3">
                            <span style="text-transform: uppercase; font-weight: bold;">11. Invoice </span>
                            <br>
                            <span style="text-transform: none; font-weight: normal;">{{ $penomoran->pib?->nomor_invoice ?? '-' }}</span>
                        </td>
                        <td class="field-label" style="width: 50%;">
                            <span style="text-transform: uppercase; font-weight: bold;" colspan="3">Tgl</span>
                            <br>
                            <span style="text-transform: none; font-weight: normal;" colspan="3">{{ $penomoran->pib?->tanggal_invoice?->translatedFormat('d F Y') ?? '-' }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label" style="width: 50%" colspan="3">
                            <span style="text-transform: uppercase; font-weight: bold;">12. BL/AWB: </span>
                            <br>
                            <span style="text-transform: none; font-weight: normal;">{{ $penomoran->pib?->nomor_bl_awb ?? '-' }}</span>
                        </td>
                        <td class="field-label" style="width: 50%;">
                            <span style="text-transform: uppercase; font-weight: bold;" colspan="3">Tgl</span>
                            <br>
                            <span style="text-transform: none; font-weight: normal;" colspan="3">{{ $penomoran->pib?->tanggal_bl_awb?->translatedFormat('d F Y') ?? '-' }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label" style="width: 50%" colspan="4">
                            <span style="text-transform: uppercase; font-weight: bold;">13. Negara Asal Barang: </span>
                            <br>
                            <span style="text-transform: none; font-weight: normal;">{{ $penomoran->pib?->negara_asal_barang ?? '-' }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label" style="width: 50%" colspan="4">
                            <span style="text-transform: uppercase; font-weight: bold;">14. Valuta </span>
                            <br>
                            <span style="text-transform: none; font-weight: normal;">{{ $penomoran->pib?->valuta ?? '-' }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label" style="width: 50%" colspan="4">
                            <span style="text-transform: uppercase; font-weight: bold;">15. FOB </span>
                            <br>
                            <span style="text-transform: none; font-weight: normal;">{{ $penomoran->pib?->fob ?? '-' }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label" style="width: 50%" colspan="4">
                            <span style="text-transform: uppercase; font-weight: bold;">16. Freight </span>
                            <br>
                            <span style="text-transform: none; font-weight: normal;">{{ $penomoran->pib?->freight_currency ?? '-' }} {{ $penomoran->pib?->freight ?? '-' }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label" style="width: 50%" colspan="4">
                            <span style="text-transform: uppercase; font-weight: bold;">17. Asuransi </span>
                            <br>
                            <span style="text-transform: none; font-weight: normal;">{{ $penomoran->pib?->asuransi ?? '-' }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label" style="width: 50%" colspan="4">
                            <span style="text-transform: uppercase; font-weight: bold;">18. Nilai CIF </span>
                            <br>
                            <span style="text-transform: none; font-weight: normal;">{{ $penomoran->pib?->nilai_cif ?? '-' }}</span>
                        </td>
                    </tr>                    
                </table>
            </td>
        </tr>
    </table>

    
    <table class="section-table">
        <thead>
            <tr>
                <th style="width: 5%; text-align: center;">No</th>
                <th style="width: 55%;">Uraian Barang</th>
                <th style="width: 15%; text-align: center;">Jumlah & Jenis Satuan</th>
                <th style="width: 12%; text-align: right;">Nilai CIF</th>                
            </tr>
        </thead>
        <tbody>
            @forelse($penomoran->uraianBarangs as $idx => $barang)
                <tr>
                    <td style="text-align: center;">{{ $idx + 1 }}</td>
                    <td>{{ $barang->uraian_barang ?? '-' }}</td>
                    <td style="text-align: center;">{{ $barang->jumlah_kemasan ?? '-' }} {{ $barang->satuan_kemasan ?? '' }} / {{ (int)($barang->berat ?? 0) }} {{ $barang->satuan ?? '' }}</td>
                    <td style="text-align: right;">{{ number_format($barang->nilai_cif ?? 0, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="subsection-title">E. HASIL PEMERIKSAAN / PENETAPAN PEJABAT BEA DAN CUKAI</div>
    @php
        $firstBarang = $penomoran->uraianBarangs->first();
        $jumlahSatuan = $firstBarang ? trim(($firstBarang->jumlah_kemasan ?? '') . ' ' . ($firstBarang->satuan_kemasan ?? '') . ' / ' . (($firstBarang->berat ?? '') . ' ' . ($firstBarang->satuan ?? ''))) : '-';
        $tarifText = '-';
        if ($firstBarang) {
            $tarifItems = [];
            if ($firstBarang->bm !== null) {
                $tarifItems[] = number_format($firstBarang->bm, 2);
            }
            if ($firstBarang->cukai !== null) {
                $tarifItems[] = number_format($firstBarang->cukai, 2);
            }
            if ($firstBarang->ppn !== null) {
                $tarifItems[] = number_format($firstBarang->ppn, 2);
            }
            if ($firstBarang->ppnbm !== null) {
                $tarifItems[] = number_format($firstBarang->ppnbm, 2);
            }
            if ($firstBarang->pph !== null) {
                $tarifItems[] = number_format($firstBarang->pph, 2);
            }
            if (count($tarifItems)) {
                $tarifText = implode(', ', $tarifItems);
            }
        }
    @endphp
    <table class="section-table">
        <thead>
            <tr>
                <th style="width: 4%; text-align: left;">23. No</th>
                <th style="width: 36%; text-align: left;">24. Uraian barang secara lengkap meliputi jenis, jumlah, merek, tipe, ukuran dan spesifikasi lainnya</th>
                <th style="width: 14%; text-align: left;">25. Jumlah & Jenis Satuan</th>
                <th style="width: 14%; text-align: left;">26. Nilai Pabean</th>
                <th style="width: 16%; text-align: left;">27. Pos Tarif / HS - Tarif BM, Cukai, PPN, PPNBM, PPh</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: center; vertical-align: top;">1</td>
                <td style="vertical-align: top;">{{ $firstBarang->uraian_barang ?? '-' }}</td>
                <td style="text-align: center; vertical-align: top;">{{ $jumlahSatuan ?: '-' }}</td>
                <td style="text-align: center; vertical-align: top;">{{ $penomoran->pib?->nilai_cif !== null ? number_format($penomoran->pib->nilai_cif, 2) : '-' }}</td>
                <td style="text-align: center; vertical-align: top;">{{ $firstBarang->pos_tarif_hs ?? '-' }}</td>
            </tr>
        <tr>
            <td class="field-label" style="style=padding: 0; width: 50%; vertical-align: top;" colspan="3">
                <table style="width: 100%; border-collapse: collapse; border: none; ">
                    <tr>
                        <td style="border: none; border-bottom: 1px solid black; padding: 2px;">
                            <span style="text-transform: uppercase; font-weight: bold;">28. NDPBM: </span>
                            <span style="text-transform: none; font-weight: normal;">
                                {{ $firstBarang?->ndpbm !== null ? number_format($firstBarang->ndpbm, 2) : '-' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="border: none; padding: 2px; text-align: center;">
                            {{ $penomoran->uraianBarangs->first()?->kota_pibk ?? '-' }},
                            {{ $penomoran->pemeriksaan?->tanggal?->translatedFormat('d F Y') ?? '-' }}
                            <br>
                            <span style="font-weight: normal;">Pejabat Bea dan Cukai</span>
                            <br><br><br>
                            <span style="font-weight: normal;">{{ $penomoran->pemeriksa?->nama_pemeriksa ?? '' }}</span>
                            <br>
                            <span style="font-weight: normal;">NIP {{ $penomoran->pemeriksa?->nip_pemeriksa ?? '' }}</span>
                        </td>
                    </tr>
                </table>
            </td>

            <td colspan="2" style="padding: 0; vertical-align: top;">
                <table style="width: 100%; border-collapse: collapse; border: none;">
                    <tr>
                        <td style="border: none; border-bottom: 1px solid black; font-weight: bold; padding: 2px;">29. Dalam Rupiah</td>
                        <td style="border: none; border-bottom: 1px solid black; text-align: right; padding: 2px;">{{ $firstBarang?->dalam_rupiah !== null ? number_format($firstBarang->dalam_rupiah, 2) : '-' }}</td>
                    </tr>
                    <tr>
                        <td style="border: none; border-bottom: 1px solid black; font-weight: bold; padding: 2px;">30. BM</td>
                        <td style="border: none; border-bottom: 1px solid black; text-align: right; padding: 2px;">{{ $firstBarang?->bm !== null ? number_format($firstBarang->bm, 2) : '-' }}</td>
                    </tr>
                    <tr>
                        <td style="border: none; border-bottom: 1px solid black; font-weight: bold; padding: 2px;">31. Cukai</td>
                        <td style="border: none; border-bottom: 1px solid black; text-align: right; padding: 2px;">{{ $firstBarang?->cukai !== null ? number_format($firstBarang->cukai, 2) : '-' }}</td>
                    </tr>
                    <tr>
                        <td style="border: none; border-bottom: 1px solid black; font-weight: bold; padding: 2px;">32. PPN</td>
                        <td style="border: none; border-bottom: 1px solid black; text-align: right; padding: 2px;">{{ $firstBarang?->ppn !== null ? number_format($firstBarang->ppn, 2) : '-' }}</td>
                    </tr>
                    <tr>
                        <td style="border: none; border-bottom: 1px solid black; font-weight: bold; padding: 2px;">33. PPnBM</td>
                        <td style="border: none; border-bottom: 1px solid black; text-align: right; padding: 2px;">{{ $firstBarang?->ppnbm !== null ? number_format($firstBarang->ppnbm, 2) : '-' }}</td>
                    </tr>
                    <tr>
                        <td style="border: none; border-bottom: 1px solid black; font-weight: bold; padding: 2px;">34. PPh</td>
                        <td style="border: none; border-bottom: 1px solid black; text-align: right; padding: 2px;">{{ $firstBarang?->pph !== null ? number_format($firstBarang->pph, 2) : '-' }}</td>
                    </tr>
                    <tr>
                        <td style="border: none; font-weight: bold; padding: 2px;">35. Total</td>
                        <td style="border: none; text-align: right; padding: 2px;">{{ $firstBarang?->total !== null ? number_format($firstBarang->total, 2) : '-' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        </tbody>
    </table>

    <div class="subsection-title">F. UNTUK PEJABAT BEA DAN CUKAI</div>
    <table class="page-table">
        <tr>
            <td style="width: 60%; padding-right: 4px; vertical-align: top;">
                <table class="section-table" style="width: 100%;">
                    <tr>
                        <th style="text-align: center;">PFPD</th>
                        <th style="text-align: center;">Pemeriksa</th>
                        <th style="text-align: center;">Pejabat Penerima</th>
                    </tr>
                    <tr>
                        <td style="text-align: center; min-height: 80px;">
                            <div>{{ $penomoran->pfpd?->nama_pfpd ?? '' }}</div>
                            <div>NIP: {{ $penomoran->pfpd?->nip_pfpd ?? '' }}</div>
                        </td>
                        <td style="text-align: center; min-height: 80px;">
                            <div>{{ $penomoran->pemeriksa?->nama_pemeriksa ?? '' }}</div>
                            <div>NIP: {{ $penomoran->pemeriksa?->nip_pemeriksa ?? '' }}</div>
                        </td>
                        <td style="text-align: center; min-height: 80px;">
                            <div>{{ $penomoran->jaminan?->pejabat_penerima ?? '' }}</div>
                        </td>
                    </tr>
                </table>
            </td>
            <td style="width: 40%; padding-left: 4px; vertical-align: top;">
                <table class="section-table" style="width: 100%;">
                    <tr>
                        <th colspan="2" style="text-align: left;">G. UNTUK PEMBAYARAN / JAMINAN</th>
                    </tr>
                    <tr>
                        <td style="width: 35%;"><strong>a. Pembayaran</strong></td>
                        <td>{{ $penomoran->jaminan?->pembayaran ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="width: 35%;"><strong>b. Jaminan</strong></td>
                        <td>{{ $penomoran->jaminan?->jaminan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Nomor</td>
                        <td>{{ '-' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Tanggal</td>
                        <td>{{ '-' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <div style="text-align: center; font-size: 9pt; margin-top: 8px;">Dokumen ini dicetak pada {{ now()->format('d-m-Y H:i:s') }}</div>
</body>
</html>

