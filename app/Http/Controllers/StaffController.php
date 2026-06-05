<?php

namespace App\Http\Controllers;

use App\Models\Penomoran;
use App\Models\Pib;
use App\Models\UraianBarang;
use App\Models\Pfpd;
use App\Models\Pemeriksa;
use App\Models\Jaminan;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    public function index()
    {
        $pengajuans = Penomoran::where('status_pengajuan', 'pending_staff')
            ->with(['penggunaJasa'])
            ->orderBy('submitted_by_pengguna_at', 'desc')
            ->get();

        return view('staff.pengajuan.index', compact('pengajuans'));
    }

    public function drafts()
    {
        $drafts = Penomoran::where('status_pengajuan', 'selesai')
            ->where('staff_id', auth()->id())
            ->with(['penggunaJasa', 'pengirim', 'penerima'])
            ->orderBy('completed_by_staff_at', 'desc')
            ->get();

        return view('staff.pengajuan.drafts', compact('drafts'));
    }

    public function edit($id)
    {
        $penomoran = Penomoran::with([
            'pengirim',
            'penerima',
            'pemberitahu',
            'suratIzin',
            'pengangkutan',
            'pib',
            'uraianBarang',
            'uraianBarangs',
            'pfpd',
            'pemeriksa',
            'jaminan',
            'pemeriksaan',
        ])->findOrFail($id);

        return view('staff.pengajuan.edit', compact('penomoran'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'penomoran' => 'required|integer|min:1|unique:penomoran,penomoran,' . $id,
            'tanggal_pibk' => 'required|date',

            'nomor_bc11' => 'nullable|string',
            'tanggal_bc11' => 'nullable|date',
            'nomor_pos' => 'nullable|string',
            'invoice' => 'nullable|string',
            'tanggal_invoice' => 'nullable|date',
            'nomor_bl_awb' => 'nullable|string',
            'tanggal_bl_awb' => 'nullable|date',
            'negara_asal_barang' => 'nullable|string',
            'valuta' => 'nullable|string',
            'fob' => 'nullable|string',
            'freight' => 'nullable|string',
            'freight_currency' => 'nullable|string',
            'asuransi' => 'nullable|string',
            'nilai_cif' => 'nullable|string',

            'uraian_barang' => 'nullable|string',
            'jumlah_kemasan' => 'nullable|string',
            'satuan_kemasan' => 'nullable|string',
            'berat' => 'nullable|string',
            'satuan' => 'nullable|string',
            'nilai_cif' => 'nullable|string',
            'kota_pibk' => 'nullable|string',
            'pemberitahu' => 'nullable|string',
            'np' => 'nullable|string',
            'pos_tarif_hs' => 'nullable|string',
            'ndpbm' => 'nullable|string',
            'dalam_rupiah' => 'nullable|string',
            'bm' => 'nullable|string',
            'cukai' => 'nullable|string',
            'ppn' => 'nullable|string',
            'ppnbm' => 'nullable|string',
            'pph' => 'nullable|string',
            'total' => 'nullable|string',

            'hari' => 'nullable|string',
            'tanggal' => 'nullable|date',
            'nama' => 'nullable|string',
            'contoh' => 'nullable|string',
            'foto' => 'nullable|string',
            'catatan' => 'nullable|string',
            'jam_mulai_periksa' => 'nullable|date_format:H:i',
            'jam_selesai_periksa' => 'nullable|date_format:H:i',
            'lokasi_pemeriksaan' => 'nullable|string',
            'kondisi_segel' => 'nullable|string',
            'jumlah_satuan_barang' => 'nullable|string',
            'satuan_barang' => 'nullable|string',
            'jenis_kemasan' => 'nullable|string',
            'ukuran_kemasan' => 'nullable|string',
            'hasil_uraian_barang' => 'nullable|string',
            'spesifikasi' => 'nullable|string',
            'keterangan' => 'nullable|string',

            'nama_pfpd' => 'nullable|string',
            'nip_pfpd' => 'nullable|string',
            'nama_pemeriksa' => 'nullable|string',
            'nip_pemeriksa' => 'nullable|string',

            'pembayaran' => 'nullable|string',
            'jaminan' => 'nullable|string',
            'pejabat_penerima' => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated, $id) {
            $penomoran = Penomoran::findOrFail($id);
            $penomoran->update([
                'penomoran' => (int) $validated['penomoran'],
                'tanggal_pibk' => $validated['tanggal_pibk'],
                'status_pengajuan' => 'selesai',
                'staff_id' => auth()->id(),
                'completed_by_staff_at' => now(),
            ]);

            $pib = $penomoran->pib ?? new Pib();
            $pib->penomoran_id = $id;
            $pib->fill([
                'nomor_bc11' => $validated['nomor_bc11'] ?? null,
                'tanggal_bc11' => $validated['tanggal_bc11'] ?? null,
                'nomor_pos' => $validated['nomor_pos'] ?? null,
                'invoice' => $validated['invoice'] ?? null,
                'tanggal_invoice' => $validated['tanggal_invoice'] ?? null,
                'nomor_bl_awb' => $validated['nomor_bl_awb'] ?? null,
                'tanggal_bl_awb' => $validated['tanggal_bl_awb'] ?? null,
                'negara_asal_barang' => $validated['negara_asal_barang'] ?? null,
                'valuta' => $validated['valuta'] ?? null,
                'fob' => $validated['fob'] ?? null,
                'freight' => $validated['freight'] ?? null,
                'freight_currency' => $validated['freight_currency'] ?? null,
                'asuransi' => $validated['asuransi'] ?? null,
                'nilai_cif' => $validated['nilai_cif'] ?? null,
            ])->save();

            $uraianBarang = $penomoran->uraianBarang ?? new UraianBarang();
            $uraianBarang->penomoran_id = $id;
            $uraianBarang->fill([
                'uraian_barang' => $validated['uraian_barang'] ?? null,
                'jumlah_kemasan' => $validated['jumlah_kemasan'] ?? null,
                'satuan_kemasan' => $validated['satuan_kemasan'] ?? null,
                'berat' => $validated['berat'] ?? null,
                'satuan' => $validated['satuan'] ?? null,
                'nilai_cif' => $validated['nilai_cif'] ?? null,
                'kota_pibk' => $validated['kota_pibk'] ?? null,
                'pemberitahu' => $validated['pemberitahu'] ?? null,
                'np' => $validated['np'] ?? null,
                'pos_tarif_hs' => $validated['pos_tarif_hs'] ?? null,
                'ndpbm' => $validated['ndpbm'] ?? null,
                'dalam_rupiah' => $validated['dalam_rupiah'] ?? null,
                'bm' => $validated['bm'] ?? null,
                'cukai' => $validated['cukai'] ?? null,
                'ppn' => $validated['ppn'] ?? null,
                'ppnbm' => $validated['ppnbm'] ?? null,
                'pph' => $validated['pph'] ?? null,
                'total' => $validated['total'] ?? null,
            ])->save();

            $pemeriksaan = $penomoran->pemeriksaan ?? new Pemeriksaan();
            $pemeriksaan->penomoran_id = $id;
            $pemeriksaan->fill([
                'hari' => $validated['hari'] ?? null,
                'tanggal' => $validated['tanggal'] ?? null,
                'nama' => $validated['nama'] ?? null,
                'contoh' => $validated['contoh'] ?? null,
                'foto' => $validated['foto'] ?? null,
                'catatan' => $validated['catatan'] ?? null,
                'jam_mulai_periksa' => $validated['jam_mulai_periksa'] ?? null,
                'jam_selesai_periksa' => $validated['jam_selesai_periksa'] ?? null,
                'lokasi_pemeriksaan' => $validated['lokasi_pemeriksaan'] ?? null,
                'kondisi_segel' => $validated['kondisi_segel'] ?? null,
                'jumlah_satuan_barang' => $validated['jumlah_satuan_barang'] ?? null,
                'satuan_barang' => $validated['satuan_barang'] ?? null,
                'jenis_kemasan' => $validated['jenis_kemasan'] ?? null,
                'ukuran_kemasan' => $validated['ukuran_kemasan'] ?? null,
                'hasil_uraian_barang' => $validated['hasil_uraian_barang'] ?? null,
                'spesifikasi' => $validated['spesifikasi'] ?? null,
                'keterangan' => $validated['keterangan'] ?? null,
            ])->save();

            $pfpd = $penomoran->pfpd ?? new Pfpd();
            $pfpd->penomoran_id = $id;
            $pfpd->fill([
                'nama_pfpd' => $validated['nama_pfpd'] ?? null,
                'nip_pfpd' => $validated['nip_pfpd'] ?? null,
            ])->save();

            $pemeriksa = $penomoran->pemeriksa ?? new Pemeriksa();
            $pemeriksa->penomoran_id = $id;
            $pemeriksa->fill([
                'nama_pemeriksa' => $validated['nama_pemeriksa'] ?? null,
                'nip_pemeriksa' => $validated['nip_pemeriksa'] ?? null,
            ])->save();

            $jaminan = $penomoran->jaminan ?? new Jaminan();
            $jaminan->penomoran_id = $id;
            $jaminan->fill([
                'pembayaran' => $validated['pembayaran'] ?? null,
                'jaminan' => $validated['jaminan'] ?? null,
                'pejabat_penerima' => $validated['pejabat_penerima'] ?? null,
            ])->save();
        });

        return redirect()->route('staff.pengajuan.index')
            ->with(['success' => 'Surat PIBK berhasil diselesaikan.']);
    }

    public function cetak($id)
    {
        return redirect()->route('penomoran-form.print', $id);
    }
}

