<?php

namespace App\Http\Controllers;

use App\Models\Penomoran;
use App\Models\Pengirim;
use App\Models\Penerima;
use App\Models\Pemberitahu;
use App\Models\SuratIzin;
use App\Models\Pengangkutan;
use App\Models\Pib;
use App\Models\UraianBarang;
use App\Models\Pfpd;
use App\Models\Pemeriksa;
use App\Models\Jaminan;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenomoranFormController extends Controller
{
    // Halaman 1: Penomoran
    public function page1($id = null)
    {
        if ($id) {
            $penomoran = Penomoran::findOrFail($id);
        } else {
            $penomoran = new Penomoran();
        }
        return view('penomoran-form.page1', ['penomoran' => $penomoran, 'id' => $id]);
    }

    // Halaman 2: Pengirim & Penerima
    public function page2($id)
    {
        $penomoran = Penomoran::findOrFail($id);
        $pengirim = $penomoran->pengirim ?? new Pengirim();
        $penerima = $penomoran->penerima ?? new Penerima();
        
        return view('penomoran-form.page2', [
            'penomoran' => $penomoran,
            'pengirim' => $pengirim,
            'penerima' => $penerima
        ]);
    }

    // Halaman 3: Pemberitahu & Surat Izin
    public function page3($id)
    {
        $penomoran = Penomoran::findOrFail($id);
        $pemberitahu = $penomoran->pemberitahu ?? new Pemberitahu();
        $suratIzin = $penomoran->suratIzin ?? new SuratIzin();
        
        return view('penomoran-form.page3', [
            'penomoran' => $penomoran,
            'pemberitahu' => $pemberitahu,
            'suratIzin' => $suratIzin
        ]);
    }

    // Halaman 4: Pengangkutan
    public function page4($id)
    {
        $penomoran = Penomoran::findOrFail($id);
        $pengangkutan = $penomoran->pengangkutan ?? new Pengangkutan();
        
        return view('penomoran-form.page4', [
            'penomoran' => $penomoran,
            'pengangkutan' => $pengangkutan
        ]);
    }

    // Halaman 5: PIB
    public function page5($id)
    {
        $penomoran = Penomoran::findOrFail($id);
        $pib = $penomoran->pib ?? new Pib();
        
        return view('penomoran-form.page5', [
            'penomoran' => $penomoran,
            'pib' => $pib
        ]);
    }

    // Halaman 6: Uraian Barang
    public function page6($id)
    {
        $penomoran = Penomoran::findOrFail($id);
        $uraianBarangs = $penomoran->uraianBarangs;
        
        return view('penomoran-form.page6', [
            'penomoran' => $penomoran,
            'uraianBarangs' => $uraianBarangs
        ]);
    }

    // Halaman 7: Pemeriksaan
    public function page7($id)
    {
        app()->setLocale('id');
        $penomoran = Penomoran::findOrFail($id);
        $pemeriksaan = $penomoran->pemeriksaan ?? new Pemeriksaan();
        
        return view('penomoran-form.page7', [
            'penomoran' => $penomoran,
            'pemeriksaan' => $pemeriksaan
        ]);
    }

    // Halaman 8: Petugas & Jaminan
    public function page8($id)
    {
        $penomoran = Penomoran::findOrFail($id);
        $pfpd = $penomoran->pfpd ?? new Pfpd();
        $pemeriksa = $penomoran->pemeriksa ?? new Pemeriksa();
        $jaminan = $penomoran->jaminan ?? new Jaminan();
        
        return view('penomoran-form.page8', [
            'penomoran' => $penomoran,
            'pfpd' => $pfpd,
            'pemeriksa' => $pemeriksa,
            'jaminan' => $jaminan
        ]);
    }

    // Halaman 9: Review Data
    public function page9($id)
    {
        $penomoran = Penomoran::with([
            'pengirim',
            'penerima',
            'pemberitahu',
            'suratIzin',
            'pengangkutan',
            'pib',
            'uraianBarangs',
            'pfpd',
            'pemeriksa',
            'jaminan',
            'pemeriksaan'
        ])->findOrFail($id);
        
        return view('penomoran-form.page9', ['penomoran' => $penomoran]);
    }

    // Simpan Halaman 1
    public function savePage1(Request $request)
    {
        $validated = $request->validate([
            'penomoran' => 'required|string|unique:penomoran,penomoran,' . $request->id,
            'tanggal_pibk' => 'nullable|date',
        ]);

        if ($request->id) {
            $penomoran = Penomoran::findOrFail($request->id);
            $penomoran->update($validated);
        } else {
            $penomoran = Penomoran::create($validated);
        }

        return redirect()->route('penomoran-form.page2', $penomoran->id);
    }

    // Simpan Halaman 2
    public function savePage2(Request $request, $id)
    {
        $penomoran = Penomoran::findOrFail($id);

        $validated = $request->validate([
            'nama_pengirim' => 'nullable|string',
            'alamat_pengirim' => 'nullable|string',
            'jenis_identitas_penerima' => 'nullable|string',
            'identitas_penerima' => 'nullable|string',
            'nama_penerima' => 'nullable|string',
            'alamat_penerima' => 'nullable|string',
        ]);

        $pengirim = $penomoran->pengirim ?? new Pengirim();
        $pengirim->penomoran_id = $id;
        $pengirim->fill([
            'nama_pengirim' => $validated['nama_pengirim'],
            'alamat_pengirim' => $validated['alamat_pengirim'],
        ])->save();

        $penerima = $penomoran->penerima ?? new Penerima();
        $penerima->penomoran_id = $id;
        $penerima->fill([
            'jenis_identitas_penerima' => $validated['jenis_identitas_penerima'],
            'identitas_penerima' => $validated['identitas_penerima'],
            'nama_penerima' => $validated['nama_penerima'],
            'alamat_penerima' => $validated['alamat_penerima'],
        ])->save();

        return redirect()->route('penomoran-form.page3', $id);
    }

    // Simpan Halaman 3
    public function savePage3(Request $request, $id)
    {
        $penomoran = Penomoran::findOrFail($id);

        $validated = $request->validate([
            'identitas_pemberitahu' => 'nullable|in:KTP,SIM,Paspor,NPWP,KITAS,KITAP,Kartu Pelajar,NIP,NIK,Lainnya',
            'nama_pemberitahu' => 'nullable|string',
            'alamat_pemberitahu' => 'nullable|string',
            'nomor_surat_izin_pjt_ppjk' => 'nullable|string',
            'tanggal_surat_izin_pjt_ppjk' => 'nullable|date',
        ]);

        $pemberitahu = $penomoran->pemberitahu ?? new Pemberitahu();
        $pemberitahu->penomoran_id = $id;
        $pemberitahu->fill([
            'identitas_pemberitahu' => $validated['identitas_pemberitahu'],
            'nama_pemberitahu' => $validated['nama_pemberitahu'],
            'alamat_pemberitahu' => $validated['alamat_pemberitahu'],
        ])->save();

        $suratIzin = $penomoran->suratIzin ?? new SuratIzin();
        $suratIzin->penomoran_id = $id;
        $suratIzin->fill([
            'nomor_surat_izin_pjt_ppjk' => $validated['nomor_surat_izin_pjt_ppjk'],
            'tanggal_surat_izin_pjt_ppjk' => $validated['tanggal_surat_izin_pjt_ppjk'],
        ])->save();

        return redirect()->route('penomoran-form.page4', $id);
    }

    // Simpan Halaman 4
    public function savePage4(Request $request, $id)
    {
        $penomoran = Penomoran::findOrFail($id);

        $validated = $request->validate([
            'cara_pengangkutan' => 'nullable|in:udara,laut,darat',
            'nama_sarkut' => 'nullable|string',
            'no_flight' => 'nullable|string',
            'pelabuhan_muat' => 'nullable|string',
            'pelabuhan_bongkar' => 'nullable|string',
        ]);

        $pengangkutan = $penomoran->pengangkutan ?? new Pengangkutan();
        $pengangkutan->penomoran_id = $id;
        $pengangkutan->fill($validated)->save();

        return redirect()->route('penomoran-form.page5', $id);
    }

    // Simpan Halaman 5
    public function savePage5(Request $request, $id)
    {
        $penomoran = Penomoran::findOrFail($id);

        $validated = $request->validate([
            'nomor_bc11' => 'nullable|string',
            'tanggal_bc11' => 'nullable|date',
            'nomor_pos' => 'nullable|string',
            'invoice' => 'nullable|string',
            'tanggal_invoice' => 'nullable|date',
            'nomor_bl_awb' => 'nullable|string',
            'tanggal_bl_awb' => 'nullable|date',
            'negara_asal_barang' => 'nullable|string',
            'valuta' => 'nullable|string|max:5',
            'fob' => 'nullable|numeric',
            'freight' => 'nullable|numeric',
            'freight_currency' => 'nullable|string|max:5',
            'asuransi' => 'nullable|numeric',
            'nilai_cif' => 'nullable|numeric',
        ]);

        $pib = $penomoran->pib ?? new Pib();
        $pib->penomoran_id = $id;
        $pib->fill($validated)->save();

        return redirect()->route('penomoran-form.page6', $id);
    }

    // Simpan Halaman 6: Uraian Barang
    public function savePage6(Request $request, $id)
    {
        $penomoran = Penomoran::findOrFail($id);

        $validated = $request->validate([
            'uraian_barang' => 'nullable|array',
            'uraian_barang.*' => 'nullable|string',
            'jumlah_kemasan' => 'nullable|array',
            'jumlah_kemasan.*' => 'nullable|numeric',
            'satuan_kemasan' => 'nullable|array',
            'satuan_kemasan.*' => 'nullable|string',
            'berat' => 'nullable|array',
            'berat.*' => 'nullable|numeric',
            'satuan' => 'nullable|array',
            'satuan.*' => 'nullable|string',
            'nilai_cif' => 'nullable|array',
            'nilai_cif.*' => 'nullable|numeric',
            'kota_pibk' => 'nullable|array',
            'kota_pibk.*' => 'nullable|string',
            'pemberitahu' => 'nullable|array',
            'pemberitahu.*' => 'nullable|string',
            'np' => 'nullable|array',
            'np.*' => 'nullable|string',
            'pos_tarif_hs' => 'nullable|array',
            'pos_tarif_hs.*' => 'nullable|string',
            'ndpbm' => 'nullable|array',
            'ndpbm.*' => 'nullable|numeric',
            'dalam_rupiah' => 'nullable|array',
            'dalam_rupiah.*' => 'nullable|numeric',
            'bm' => 'nullable|array',
            'bm.*' => 'nullable|numeric',
            'cukai' => 'nullable|array',
            'cukai.*' => 'nullable|numeric',
            'ppn' => 'nullable|array',
            'ppn.*' => 'nullable|numeric',
            'ppnbm' => 'nullable|array',
            'ppnbm.*' => 'nullable|numeric',
            'pph' => 'nullable|array',
            'pph.*' => 'nullable|numeric',
            'total' => 'nullable|array',
            'total.*' => 'nullable|numeric',
        ]);

        // Hapus uraian barang lama
        UraianBarang::where('penomoran_id', $id)->delete();

        // Simpan uraian barang baru
        if ($validated['uraian_barang']) {
            for ($i = 0; $i < count($validated['uraian_barang']); $i++) {
                UraianBarang::create([
                    'penomoran_id' => $id,
                    'uraian_barang' => $validated['uraian_barang'][$i],
                    'jumlah_kemasan' => $validated['jumlah_kemasan'][$i],
                    'satuan_kemasan' => $validated['satuan_kemasan'][$i] ?? null,
                    'berat' => $validated['berat'][$i],
                    'satuan' => $validated['satuan'][$i] ?? null,
                    'nilai_cif' => $validated['nilai_cif'][$i],
                    'kota_pibk' => $validated['kota_pibk'][$i],
                    'pemberitahu' => $validated['pemberitahu'][$i],
                    'np' => $validated['np'][$i],
                    'pos_tarif_hs' => $validated['pos_tarif_hs'][$i],
                    'ndpbm' => $validated['ndpbm'][$i],
                    'dalam_rupiah' => $validated['dalam_rupiah'][$i],
                    'bm' => $validated['bm'][$i],
                    'cukai' => $validated['cukai'][$i],
                    'ppn' => $validated['ppn'][$i],
                    'ppnbm' => $validated['ppnbm'][$i],
                    'pph' => $validated['pph'][$i],
                    'total' => $validated['total'][$i],
                ]);
            }
        }

        return redirect()->route('penomoran-form.page7', $id);
    }

    // Simpan Halaman 7
    public function savePage7(Request $request, $id)
    {
        $penomoran = Penomoran::findOrFail($id);

        $validated = $request->validate([
            'hari' => 'nullable|string',
            'tanggal_hari' => 'nullable|integer|min:1|max:31|required_with:tanggal_bulan,tanggal_tahun',
            'tanggal_bulan' => 'nullable|integer|min:1|max:12|required_with:tanggal_hari,tanggal_tahun',
            'tanggal_tahun' => 'nullable|integer|min:1900|max:2100|required_with:tanggal_hari,tanggal_bulan',
            'nama' => 'nullable|string',
            'contoh' => 'nullable|string',
            'foto' => 'nullable|string',
            'catatan' => 'nullable|string',
            'jam_mulai_periksa' => 'nullable|date_format:H:i',
            'jam_selesai_periksa' => 'nullable|date_format:H:i',
            'lokasi_pemeriksaan' => 'nullable|string',
            'kondisi_segel' => 'nullable|string',
            'jumlah_satuan_barang' => 'nullable|integer|min:0',
            'satuan_barang' => 'nullable|string|max:50',
            'jenis_kemasan' => 'nullable|string',
            'ukuran_kemasan' => 'nullable|string',
            'hasil_uraian_barang' => 'nullable|string',
            'spesifikasi' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        $validated['tanggal'] = null;
        if (!empty($validated['tanggal_hari']) && !empty($validated['tanggal_bulan']) && !empty($validated['tanggal_tahun'])) {
            if (checkdate($validated['tanggal_bulan'], $validated['tanggal_hari'], $validated['tanggal_tahun'])) {
                $validated['tanggal'] = sprintf('%04d-%02d-%02d', $validated['tanggal_tahun'], $validated['tanggal_bulan'], $validated['tanggal_hari']);
            } else {
                return redirect()->back()->withErrors(['tanggal_hari' => 'Tanggal pemeriksaan tidak valid'])->withInput();
            }
        }
        unset($validated['tanggal_hari'], $validated['tanggal_bulan'], $validated['tanggal_tahun']);

        $pemeriksaan = $penomoran->pemeriksaan ?? new Pemeriksaan();
        $pemeriksaan->penomoran_id = $id;
        $pemeriksaan->fill($validated)->save();

        return redirect()->route('penomoran-form.page8', $id);
    }

    // Simpan Halaman 8
    public function savePage8(Request $request, $id)
    {
        $penomoran = Penomoran::findOrFail($id);

        $validated = $request->validate([
            'nama_pfpd' => 'nullable|string',
            'nip_pfpd' => 'nullable|string',
            'nama_pemeriksa' => 'nullable|string',
            'nip_pemeriksa' => 'nullable|string',
            'pembayaran' => 'nullable|string',
            'jaminan' => 'nullable|string',
            'pejabat_penerima' => 'nullable|string',
        ]);

        $pfpd = $penomoran->pfpd ?? new Pfpd();
        $pfpd->penomoran_id = $id;
        $pfpd->fill([
            'nama_pfpd' => $validated['nama_pfpd'],
            'nip_pfpd' => $validated['nip_pfpd'],
        ])->save();

        $pemeriksa = $penomoran->pemeriksa ?? new Pemeriksa();
        $pemeriksa->penomoran_id = $id;
        $pemeriksa->fill([
            'nama_pemeriksa' => $validated['nama_pemeriksa'],
            'nip_pemeriksa' => $validated['nip_pemeriksa'],
        ])->save();

        $jaminan = $penomoran->jaminan ?? new Jaminan();
        $jaminan->penomoran_id = $id;
        $jaminan->fill([
            'pembayaran' => $validated['pembayaran'],
            'jaminan' => $validated['jaminan'],
            'pejabat_penerima' => $validated['pejabat_penerima'],
        ])->save();

        return redirect()->route('penomoran-form.page9', $id);
    }

    // Simpan Halaman 9 (Final Save)
    public function savePage9(Request $request, $id)
    {
        $penomoran = Penomoran::findOrFail($id);
        
        // Update any changes from page9 (edit mode)
        $validated = $request->validate([
            'penomoran' => 'required|string|unique:penomoran,penomoran,' . $id,
            'tanggal_pibk' => 'nullable|date',
        ]);

        $penomoran->update($validated);

        return redirect()->route('penomoran-form.list')->with('success', 'Data berhasil disimpan');
    }

    // Halaman List
    public function list()
    {
        $pnomorans = Penomoran::paginate(10);
        return view('penomoran-form.list', ['pnomorans' => $pnomorans]);
    }

    // Read/Show
    public function show($id)
    {
        return $this->page9($id);
    }

    // Print
    public function print($id)
    {
        $penomoran = Penomoran::with([
            'pengirim',
            'penerima',
            'pemberitahu',
            'suratIzin',
            'pengangkutan',
            'pib',
            'uraianBarangs',
            'pfpd',
            'pemeriksa',
            'jaminan',
            'pemeriksaan'
        ])->findOrFail($id);
        
        return view('penomoran-form.print', ['penomoran' => $penomoran]);
    }

    public function printIp($id)
    {
        $penomoran = Penomoran::with([
            'pengirim',
            'penerima',
            'pemberitahu',
            'suratIzin',
            'pengangkutan',
            'pib',
            'uraianBarangs',
            'pfpd',
            'pemeriksa'
        ])->findOrFail($id);

        return view('penomoran-form.print-ip', ['penomoran' => $penomoran]);
    }

    public function printSppb($id)
    {
        $penomoran = Penomoran::with([
            'pengirim',
            'penerima',
            'pemberitahu',
            'suratIzin',
            'pengangkutan',
            'pib',
            'uraianBarangs',
            'pfpd',
            'pemeriksa',
            'jaminan',
            'pemeriksaan'
        ])->findOrFail($id);

        return view('penomoran-form.print-sppb', ['penomoran' => $penomoran]);
    }

    public function printLhpIp($id)
    {
        $penomoran = Penomoran::with([
            'penerima',
            'uraianBarangs',
            'pemeriksaan',
            'pemeriksa',
            'pfpd',
            'pib'
        ])->findOrFail($id);

        return view('penomoran-form.print-lhp-ip', ['penomoran' => $penomoran]);
    }

    // Delete
    public function destroy($id)
    {
        try {
            $penomoran = Penomoran::findOrFail($id);
            $penomoran->delete();
            
            return redirect()->route('penomoran-form.list')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('penomoran-form.list')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    // Kembali ke halaman sebelumnya
    public function back($id, $page)
    {
        $page = (int)$page;
        if ($page > 1) {
            $prevPage = $page - 1;
            if ($prevPage == 1) {
                return redirect()->route('penomoran-form.edit', $id);
            } else {
                return redirect()->route('penomoran-form.page' . $prevPage, $id);
            }
        }
        return redirect()->route('penomoran-form.list');
    }
}
