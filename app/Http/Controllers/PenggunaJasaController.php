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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenggunaJasaController extends Controller
{
    public function dashboard()
    {
        return view('pengguna_jasa.dashboard');
    }

    public function index()
    {
        $pengajuans = Penomoran::where('pengguna_jasa_id', auth()->id())
            ->with(['pengirim', 'penerima', 'pemberitahu', 'suratIzin', 'pengangkutan'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pengguna_jasa.pengajuan.index', compact('pengajuans'));
    }

    public function create()
    {
        return view('pengguna_jasa.pengajuan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pengirim' => 'nullable|string',
            'alamat_pengirim' => 'nullable|string',
            'jenis_identitas_penerima' => 'nullable|string',
            'identitas_penerima' => 'nullable|string',
            'nama_penerima' => 'nullable|string',
            'alamat_penerima' => 'nullable|string',
            'identitas_pemberitahu' => 'nullable|in:KTP,SIM,Paspor,NPWP,KITAS,KITAP,Kartu Pelajar,NIP,NIK,Lainnya',
            'nama_pemberitahu' => 'nullable|string',
            'alamat_pemberitahu' => 'nullable|string',
            'nomor_surat_izin_pjt_ppjk' => 'nullable|string',
            'tanggal_surat_izin_pjt_ppjk' => 'nullable|date',
            'nomor_bc11' => 'nullable|string',
            'tanggal_bc11' => 'nullable|date',
            'nomor_pos' => 'nullable|string',
            'invoice' => 'nullable|string',
            'tanggal_invoice' => 'nullable|date',
            'nomor_bl_awb' => 'nullable|string',
            'tanggal_bl_awb' => 'nullable|date',
            'negara_asal_barang' => 'nullable|string',
            'valuta' => 'nullable|string',
            'fob' => 'nullable|numeric',
            'freight' => 'nullable|numeric',
            'freight_currency' => 'nullable|string',
            'asuransi' => 'nullable|numeric',
            'nilai_cif' => 'nullable|numeric',
            'uraian_barang' => 'nullable|string',
            'jumlah_kemasan' => 'nullable|numeric',
            'satuan_kemasan' => 'nullable|string',
            'berat' => 'nullable|numeric',
            'satuan' => 'nullable|string',
            'uraian_nilai_cif' => 'nullable|numeric',
            'kota_pibk' => 'nullable|string',
            'pemberitahu' => 'nullable|string',
            'np' => 'nullable|string',
            'pos_tarif_hs' => 'nullable|string',
            'ndpbm' => 'nullable|numeric',
            'dalam_rupiah' => 'nullable|numeric',
            'bm' => 'nullable|numeric',
            'cukai' => 'nullable|numeric',
            'ppn' => 'nullable|numeric',
            'ppnbm' => 'nullable|numeric',
            'pph' => 'nullable|numeric',
            'total' => 'nullable|numeric',
            'cara_pengangkutan' => 'nullable|in:udara,laut,darat',
            'nama_sarkut' => 'nullable|string',
            'no_flight' => 'nullable|string',
            'pelabuhan_muat' => 'nullable|string',
            'pelabuhan_bongkar' => 'nullable|string',
        ]);

        $penomoran = null;

        DB::transaction(function () use ($validated, &$penomoran) {
            $nextPenomoran = (Penomoran::max('penomoran') ?? 0) + 1;

            $penomoran = Penomoran::create([
                'penomoran' => $nextPenomoran,
                'tanggal_pibk' => now()->toDateString(),
                'status_pengajuan' => 'pending_staff',
                'pengguna_jasa_id' => auth()->id(),
                'submitted_by_pengguna_at' => now(),
            ]);

            $pengirim = $penomoran->pengirim ?? new Pengirim();
            $pengirim->penomoran_id = $penomoran->id;
            $pengirim->fill([
                'nama_pengirim' => $validated['nama_pengirim'] ?? null,
                'alamat_pengirim' => $validated['alamat_pengirim'] ?? null,
            ])->save();

            $penerima = $penomoran->penerima ?? new Penerima();
            $penerima->penomoran_id = $penomoran->id;
            $penerima->fill([
                'jenis_identitas_penerima' => $validated['jenis_identitas_penerima'] ?? null,
                'identitas_penerima' => $validated['identitas_penerima'] ?? null,
                'nama_penerima' => $validated['nama_penerima'] ?? null,
                'alamat_penerima' => $validated['alamat_penerima'] ?? null,
            ])->save();

            $pemberitahu = $penomoran->pemberitahu ?? new Pemberitahu();
            $pemberitahu->penomoran_id = $penomoran->id;
            $pemberitahu->fill([
                'identitas_pemberitahu' => $validated['identitas_pemberitahu'] ?? null,
                'nama_pemberitahu' => $validated['nama_pemberitahu'] ?? null,
                'alamat_pemberitahu' => $validated['alamat_pemberitahu'] ?? null,
            ])->save();

            $suratIzin = $penomoran->suratIzin ?? new SuratIzin();
            $suratIzin->penomoran_id = $penomoran->id;
            $suratIzin->fill([
                'nomor_surat_izin_pjt_ppjk' => $validated['nomor_surat_izin_pjt_ppjk'] ?? null,
                'tanggal_surat_izin_pjt_ppjk' => $validated['tanggal_surat_izin_pjt_ppjk'] ?? null,
            ])->save();

            $pib = $penomoran->pib ?? new Pib();
            $pib->penomoran_id = $penomoran->id;
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
            $uraianBarang->penomoran_id = $penomoran->id;
            $uraianBarang->fill([
                'uraian_barang' => $validated['uraian_barang'] ?? null,
                'jumlah_kemasan' => $validated['jumlah_kemasan'] ?? null,
                'satuan_kemasan' => $validated['satuan_kemasan'] ?? null,
                'berat' => $validated['berat'] ?? null,
                'satuan' => $validated['satuan'] ?? null,
                'nilai_cif' => $validated['uraian_nilai_cif'] ?? null,
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

            $pengangkutan = $penomoran->pengangkutan ?? new Pengangkutan();
            $pengangkutan->penomoran_id = $penomoran->id;
            $pengangkutan->fill([
                'cara_pengangkutan' => $validated['cara_pengangkutan'] ?? null,
                'nama_sarkut' => $validated['nama_sarkut'] ?? null,
                'no_flight' => $validated['no_flight'] ?? null,
                'pelabuhan_muat' => $validated['pelabuhan_muat'] ?? null,
                'pelabuhan_bongkar' => $validated['pelabuhan_bongkar'] ?? null,
            ])->save();
        });

        return redirect()->route('pengguna-jasa.pengajuan.show', $penomoran->id)
            ->with(['success' => 'Pengajuan berhasil dikirim ke staff untuk diproses.']);
    }

    public function show($id)
    {
        $penomoran = Penomoran::where('id', $id)
            ->where('pengguna_jasa_id', auth()->id())
            ->with(['pengirim', 'penerima', 'pemberitahu', 'suratIzin', 'pengangkutan', 'pib', 'uraianBarangs'])
            ->firstOrFail();

        return view('pengguna_jasa.pengajuan.show', compact('penomoran'));
    }
}
