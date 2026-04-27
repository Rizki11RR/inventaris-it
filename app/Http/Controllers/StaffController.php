<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        // 1. Hitung Total Seluruh Perangkat
        $totalAssets = \App\Models\Asset::count();

        // 2. Hitung Perangkat yang Belum Dinilai AHP
        $dinilaiIds = \App\Models\Assessment::pluck('asset_id');
        $belumDinilai = \App\Models\Asset::whereNotIn('id', $dinilaiIds)->count();

        // 3. Hitung Perangkat Kritis/Rusak (Berdasarkan Rekomendasi AHP)
        $perangkatRusak = \App\Models\Assessment::where('rekomendasi', 'like', '%Diganti%')
                            ->orWhere('rekomendasi', 'like', '%Perbaikan%')
                            ->count();

        // 4. Hitung Total Riwayat Maintenance
        $totalMaintenance = \App\Models\Maintenance::count();

        // 5. Ambil 5 Data Maintenance Terakhir untuk Tabel Aktivitas
        $recentMaintenances = \App\Models\Maintenance::with('asset')
                                ->orderBy('tanggal_perawatan', 'desc')
                                ->take(5)
                                ->get();

        // Pastikan memanggil nama file view Anda dengan benar (misal: staff.dashboard)
        return view('staff.dashboard', compact(
            'totalAssets', 
            'belumDinilai', 
            'perangkatRusak', 
            'totalMaintenance', 
            'recentMaintenances'
        ));
    }
}