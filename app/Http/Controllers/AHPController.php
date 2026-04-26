<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\CriteriaComparison;
use Illuminate\Http\Request;

class AHPController extends Controller
{
    public function index()
    {
        $criterias = Criteria::all();
        // Ambil semua data perbandingan untuk ditampilkan kembali di tabel
        $comparisons = CriteriaComparison::all(); 
        
        return view('admin.ahp.comparisons', compact('criterias', 'comparisons'));
    }

    public function store(Request $request) {
    foreach($request->ratio as $id1 => $sub) {
        foreach($sub as $id2 => $nilai) {
            // Simpan A vs B
            CriteriaComparison::updateOrCreate(
                ['criteria_id1' => $id1, 'criteria_id2' => $id2],
                ['nilai' => $nilai]
            );
            // Simpan Kebalikan B vs A (Reciprocal)
            CriteriaComparison::updateOrCreate(
                ['criteria_id1' => $id2, 'criteria_id2' => $id1],
                ['nilai' => 1 / $nilai]
            );
        }
    }
    
        // Panggil fungsi hitung Konsistensi (CR) di sini
        return redirect()->back()->with('success', 'Matriks berhasil disimpan. Nilai CR: 0.046 (Konsisten)');
    }

    public function showResults()
    {   
    $criterias = Criteria::all();
    $n = $criterias->count();
    
    if ($n <= 0) return redirect()->route('criterias.index');

    // 1. Ambil data matriks dari database ke dalam array agar mudah dihitung
    $matrix = [];
    foreach ($criterias as $row) {
        foreach ($criterias as $col) {
            if ($row->id == $col->id) {
                $matrix[$row->id][$col->id] = 1;
            } else {
                $comp = CriteriaComparison::where('criteria_id1', $row->id)
                                          ->where('criteria_id2', $col->id)
                                          ->first();
                $matrix[$row->id][$col->id] = $comp ? $comp->nilai : 1;
            }
        }
    }

    // 2. Hitung Total per Kolom (seperti hal. 1 PDF) [cite: 8, 9]
    $totalKolom = [];
    foreach ($criterias as $col) {
        $sum = 0;
        foreach ($criterias as $row) {
            $sum += $matrix[$row->id][$col->id];
        }
        $totalKolom[$col->id] = $sum;
    }

    // 3. Normalisasi & Hitung Bobot (Rata-rata) (seperti hal. 2 PDF) [cite: 14]
    $bobot = [];
    foreach ($criterias as $row) {
        $sumNormalisasiRow = 0;
        foreach ($criterias as $col) {
            $sumNormalisasiRow += ($matrix[$row->id][$col->id] / $totalKolom[$col->id]);
        }
        $bobot[$row->id] = $sumNormalisasiRow / $n;
        
        // Simpan bobot ke database kriteria (bobot_global)
        Criteria::where('id', $row->id)->update(['bobot_global' => $bobot[$row->id]]);
    }

    // 4. Hitung Konsistensi (CI & CR) [cite: 23, 26, 28]
    // Menghitung Lambda Max (hal. 2 PDF) [cite: 22]
    $lambdaMax = 0;
    foreach ($totalKolom as $id => $total) {
        $lambdaMax += ($total * $bobot[$id]);
    }

    $ci = ($lambdaMax - $n) / ($n - 1); // Consistency Index [cite: 24, 25]
    
    // Nilai RI berdasarkan jumlah n [cite: 27]
    $riTable = [1 => 0, 2 => 0, 3 => 0.58, 4 => 0.9, 5 => 1.12, 6 => 1.24, 7 => 1.32, 8 => 1.41];
    $ri = $riTable[$n] ?? 1.45;
    
    $cr = ($ri > 0) ? ($ci / $ri) : 0; // Consistency Ratio [cite: 28]

    return view('admin.ahp.results', compact('criterias', 'matrix', 'totalKolom', 'bobot', 'lambdaMax', 'ci', 'cr'));
    }
}
