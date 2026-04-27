<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Asset;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function index()
    {
        // Mengambil data penilaian terbaru
        $results = Assessment::with('asset')->latest()->get();
        return view('admin.monitoring.index', compact('results'));
    }

    public function reset($id)
    {
        $assessment = Assessment::findOrFail($id);
        $assetId = $assessment->asset_id;

        // Hapus riwayat penilaian
        $assessment->delete();

        // Update skor_ahp di tabel assets menjadi null agar bisa dinilai ulang
        $asset = Asset::find($assetId);
        if ($asset) {
            $asset->update(['skor_ahp' => null]);
        }

        return redirect()->back()->with('success', 'Penilaian berhasil direset.');
    }
}