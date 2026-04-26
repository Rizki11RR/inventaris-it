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
}
