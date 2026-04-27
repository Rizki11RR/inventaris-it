<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Assessment;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function index() {
        // 1. Ambil semua ID aset yang sudah pernah dinilai
        $doneIds = Assessment::pluck('asset_id')->toArray();

        // 2. Ambil aset yang ID-nya TIDAK ADA di dalam daftar $doneIds
        $assets = Asset::with(['category', 'status'])
                    ->whereNotIn('id', $doneIds) 
                    ->get();

        return view('staff.assessments.index', compact('assets'));
    }

    public function create($id)
    {
        // Tambahkan \App\Models\ di depan Asset
        $asset = \App\Models\Asset::with('location')->findOrFail($id);
        
        // Tambahkan \App\Models\ di depan Criteria
        $criterias = \App\Models\Criteria::with('subCriterias')->get();
        
        return view('staff.assessments.create', compact('asset', 'criterias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'criteria' => 'required|array', 
        ]);

        $totalScore = 0;

        foreach ($request->criteria as $criteriaId => $nilaiInput) {
            $criteria = \App\Models\Criteria::find($criteriaId);
            
            // Ambil bobot kriteria hasil hitung AHP Admin
            $bobotKriteria = $criteria->bobot_global ?? 0;

            // Rumus AHP: Nilai Input (skala 1-5) * Bobot Global Kriteria
            // Kita bagi 5 agar nilainya ternormalisasi ke 0-1 jika skala Anda 1-5
            $totalScore += ($bobotKriteria * ($nilaiInput / 5));
        }

        // Penentuan Rekomendasi berdasarkan totalScore (0.0 - 1.0)
        if ($totalScore >= 0.8) {
            $rekomendasi = 'Sangat Layak';
        } elseif ($totalScore >= 0.6) {
            $rekomendasi = 'Layak';
        } elseif ($totalScore >= 0.4) {
            $rekomendasi = 'Cukup / Perbaikan';
        } else {
            $rekomendasi = 'Tidak Layak / Diganti';
        }

        // Simpan ke Database
        Assessment::create([
            'asset_id' => $request->asset_id,
            'user_id' => auth()->id(),
            'total_score' => $totalScore,
            'rekomendasi' => $rekomendasi,
            'tanggal_penilaian' => now(),
        ]);

        $asset = \App\Models\Asset::find($request->asset_id);
        $asset->skor_ahp = $totalScore;
        $asset->save();

        return redirect()->route('staff.assessments.history')->with('success', "Penilaian berhasil disimpan dan skor aset telah diperbarui!");
    }

    public function history()
    {
        // 1. Pastikan nama variabelnya adalah $assessments
        // 2. Gunakan with('asset', 'user') agar relasi data dipanggil secara efisien (mencegah N+1 query problem)
        $assessments = \App\Models\Assessment::with(['asset', 'user'])
                            ->orderBy('tanggal_penilaian', 'desc')
                            ->get();

        // 3. Kirimkan ke view menggunakan compact
        return view('staff.assessments.history', compact('assessments'));
    }

    public function reset($id)
    {
        // 1. Cari data penilaian di tabel assessments
        $assessment = \App\Models\Assessment::findOrFail($id);
        
        // 2. Ambil ID aset yang terkait sebelum data penilaian dihapus
        $assetId = $assessment->asset_id;

        // 3. Hapus data penilaian tersebut
        $assessment->delete();

        // 4. Update tabel assets: kembalikan skor_ahp menjadi NULL
        // Ini otomatis membuat aset muncul lagi di antrean penilaian Staff
        $asset = \App\Models\Asset::find($assetId);
        $asset->skor_ahp = null;
        $asset->save();

        return redirect()->back()->with('success', 'Penilaian telah direset. Staff dapat menginput ulang kondisi perangkat tersebut.');
    }

    
}
