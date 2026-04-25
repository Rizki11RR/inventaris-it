<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\SubCriteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    public function index() {
        $criterias = Criteria::with('subCriterias')->get();
        return view('admin.criterias.index', compact('criterias'));
    }

    public function store(Request $request) {
        $request->validate(['nama_kriteria' => 'required']);
        Criteria::create($request->all());
        return redirect()->back()->with('success', 'Kriteria berhasil ditambah');
    }

    public function update(Request $request, Criteria $criteria)
    {
        $validated = $request->validate([
            'nama_kriteria' => 'required|string|max:255',
        ]);

        $criteria->update($validated);

        return redirect()->back()->with('success', 'Kriteria berhasil diperbarui!');
    }
    // CRUD Bobot (Sub-Kriteria)
    public function storeSub(Request $request) {
        $request->validate([
            'criteria_id' => 'required',
            'nama_sub' => 'required',
            'nilai' => 'required|numeric'
        ]);
        SubCriteria::create($request->all());
        return redirect()->back()->with('success', 'Bobot nilai berhasil ditambah');
    }

    public function destroySub($id) {
        SubCriteria::find($id)->delete();
        return redirect()->back()->with('success', 'Bobot nilai dihapus');
    }
}
