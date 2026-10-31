<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\CriteriaComparison;
use App\Services\AhpCalculator;
use Illuminate\Http\Request;
use InvalidArgumentException;

class AHPController extends Controller
{
    public function index()
    {
        $criterias = Criteria::all();
        $comparisons = CriteriaComparison::all();
        return view('admin.ahp.comparisons', compact('criterias', 'comparisons'));
    }

    public function store(Request $request)
    {
        $criterias = Criteria::all();
        $request->validate(['ratio' => 'required|array']);
        $ratio = $request->input('ratio');
        $matrix = [];
        foreach ($criterias as $rowIndex => $row) {
            foreach ($criterias as $colIndex => $col) {
                if ($rowIndex === $colIndex) {
                    $matrix[$row->id][$col->id] = 1;
                } elseif ($colIndex > $rowIndex) {
                    $matrix[$row->id][$col->id] = $ratio[$row->id][$col->id] ?? null;
                } else {
                    $upperRow = $criterias[$colIndex];
                    $upperCol = $criterias[$rowIndex];
                    $value = $ratio[$upperRow->id][$upperCol->id] ?? null;
                    $matrix[$row->id][$col->id] = $value === null ? null : 1 / (float) $value;
                }
            }
        }
        try {
            (new AhpCalculator)->calculate($matrix);
        } catch (InvalidArgumentException $e) {
            return redirect()->back()->withErrors(['ratio' => $e->getMessage()])->withInput();
        }
        foreach ($criterias as $row) {
            foreach ($criterias as $col) {
                if ($row->id < $col->id) {
                    $value = (float) $matrix[$row->id][$col->id];
                    CriteriaComparison::updateOrCreate(['criteria_id1' => $row->id, 'criteria_id2' => $col->id], ['nilai' => $value]);
                    CriteriaComparison::updateOrCreate(['criteria_id1' => $col->id, 'criteria_id2' => $row->id], ['nilai' => 1 / $value]);
                }
            }
        }
        return redirect()->back()->with('success', 'Matriks berhasil disimpan.');
    }

    public function showResults()
    {
        $criterias = Criteria::all();
        $matrix = [];
        foreach ($criterias as $row) foreach ($criterias as $col) {
            $matrix[$row->id][$col->id] = $row->id === $col->id ? 1 : optional(CriteriaComparison::where('criteria_id1', $row->id)->where('criteria_id2', $col->id)->first())->nilai;
        }
        try { $result = (new AhpCalculator)->calculate($matrix); }
        catch (InvalidArgumentException $e) { return redirect()->route('ahp.comparisons')->withErrors(['ratio' => $e->getMessage()]); }
        $bobot = $result['weights'];
        foreach ($bobot as $id => $weight) Criteria::whereKey($id)->update(['bobot_global' => $weight]);
        return view('admin.ahp.results', ['criterias' => $criterias, 'matrix' => $matrix, 'totalKolom' => $result['totals']] + $result + ['bobot' => $bobot]);
    }
}
