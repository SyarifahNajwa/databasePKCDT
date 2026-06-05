<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penomoran;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalPenomorans = Penomoran::count();
        $totalUsers = User::count();
        $totalStaff = User::where('role', 'staff')->count();
        $totalPenggunaJasa = User::where('role', 'pengguna_jasa')->count();
        
        // Recent surat
        $recentSurats = Penomoran::with(['pengirim', 'penerima', 'pengangkutan'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Surat by status
        $suratByStatus = Penomoran::selectRaw('status_pengajuan, count(*) as total')
            ->groupBy('status_pengajuan')
            ->get();

        return view('admin.dashboard', compact(
            'totalPenomorans',
            'totalUsers',
            'totalStaff',
            'totalPenggunaJasa',
            'recentSurats',
            'suratByStatus'
        ));
    }
}
