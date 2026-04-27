<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Assessment;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function index() {
        $assets = Asset::with(['category', 'status'])->get();
        return view('staff.assessments.index', compact('assets'));
    }

    public function create(Asset $asset) {
        // Mengambil kriteria untuk proses perbandingan AHP
        $criterias = \App\Models\Criteria::all();
        return view('staff.assessments.create', compact('asset', 'criterias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'criteria' => 'required|array', // key: criteria_id, value: sub_criteria_id
        ]);

        $totalScore = 0;

        foreach ($request->criteria as $criteriaId => $subCriteriaId) {
            $criteria = \App\Models\Criteria::find($criteriaId);
            $subCriteria = \App\Models\SubCriteria::find($subCriteriaId);
            
            // Ambil bobot kriteria (dari AHP) dan bobot sub-kriteria
            $bobotKriteria = $criteria->bobot_global ?? 0;
            $bobotSub = $subCriteria->bobot ?? 0; 

            // Rumus: Bobot Kriteria * Nilai Sub-Kriteria
            $totalScore += ($bobotKriteria * $bobotSub);
        }

        // PENYESUAIAN AMBANG BATAS (Threshold)
        // Jika skala sub-kriteria Anda 1-5, maka totalScore maksimal adalah 5.
        // Jika sub-kriteria sudah dinormalisasi (0-1), maka totalScore maksimal adalah 1.
        
        if ($totalScore >= 0.8) { // Asumsi skala 0 - 1.0
            $rekomendasi = 'Sangat Layak';
        } elseif ($totalScore >= 0.6) {
            $rekomendasi = 'Layak';
        } elseif ($totalScore >= 0.4) {
            $rekomendasi = 'Cukup / Perbaikan';
        } else {
            $rekomendasi = 'Tidak Layak / Diganti';
        }

        // Update status aset secara otomatis berdasarkan hasil
        $asset = Asset::find($request->asset_id);
        // Logika: Jika tidak layak, update status_id ke 'Rusak' (sesuaikan ID-nya)
        if ($totalScore < 0.4) {
            $asset->update(['status_id' => 4]); // Contoh ID 4 = Rusak Berat
        }

        \App\Models\Assessment::create([
            'asset_id' => $request->asset_id,
            'user_id' => auth()->id(),
            'total_score' => $totalScore,
            'rekomendasi' => $rekomendasi,
            'tanggal_penilaian' => now(),
        ]);

        return redirect()->route('staff.assessments.history')
                        ->with('success', "Penilaian berhasil disimpan!");
    }

    public function history() 
    {
        $histories = Assessment::with(['asset', 'asset.category'])
                    ->orderBy('tanggal_penilaian', 'desc')
                    ->get();
        return view('staff.assessments.history', compact('histories'));
    }
}
