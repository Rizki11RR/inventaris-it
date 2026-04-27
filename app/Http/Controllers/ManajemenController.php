<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Assessment;

class ManajemenController extends Controller
{
    public function index()
    {
        // Statistik Utama
        $totalAssets = Asset::count();
        $totalAssessments = Assessment::count();
        
        // Menghitung jumlah per rekomendasi untuk Grafik
        $dataGrafik = [
            'layak' => Assessment::where('rekomendasi', 'Layak')->count(),
            'perbaikan' => Assessment::where('rekomendasi', 'Cukup / Perbaikan')->count(),
            'ganti' => Assessment::where('rekomendasi', 'Tidak Layak / Diganti')->count(),
        ];

        // Ambil 5 perangkat dengan skor terendah (paling kritis)
        $worstAssets = Assessment::with('asset')
                        ->orderBy('total_score', 'asc')
                        ->take(5)
                        ->get();

        return view('manajemen.dashboard', compact('totalAssets', 'totalAssessments', 'dataGrafik', 'worstAssets'));
    }

    public function laporan()
    {
        // Mengambil semua data dari tabel assessments
        // Serta menarik data asset dan category yang terhubung
        $rekomendasi = \App\Models\Assessment::with(['asset.category'])
            ->orderBy('total_score', 'desc') // Ranking dari skor tertinggi (Sangat Layak) ke rendah
            ->get();

        return view('manajemen.laporan', compact('rekomendasi'));
    }

    public function cetak()
    {
        // Perhatikan backslash (\) setelah Models, bukan titik dua (::)
        $rekomendasi = \App\Models\Assessment::with(['asset.category', 'asset.location'])
            ->orderBy('total_score', 'desc')
            ->get();

        $tanggal = date('d F Y');

        return view('manajemen.cetak_pdf', compact('rekomendasi', 'tanggal'));
    }
}