<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Location;
use App\Models\Vendor;
use App\Models\Status;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::with(['category', 'location', 'vendor', 'status'])->get();
        $categories = Category::all();
        $locations = Location::all();
        $vendors = Vendor::all();
        $statuses = Status::all();

        return view('staff.assets.index', compact('assets', 'categories', 'locations', 'vendors', 'statuses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_aset' => 'required|unique:assets',
            'nama_perangkat' => 'required',
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
            'vendor_id' => 'required|exists:vendors,id',
            'status_id' => 'required|exists:statuses,id',
            'tanggal_pengadaan' => 'required|date',
        ]);

        Asset::create($validated);
        return back()->with('success', 'Aset berhasil ditambahkan!');
    }

    // TAMBAHKAN FUNGSI UPDATE INI
    public function update(Request $request, Asset $asset)
    {
        $validated = $request->validate([
            'kode_aset' => 'required|unique:assets,kode_aset,' . $asset->id,
            'nama_perangkat' => 'required',
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
            'vendor_id' => 'required|exists:vendors,id',
            'status_id' => 'required|exists:statuses,id',
            'tanggal_pengadaan' => 'required|date',
        ]);

        $asset->update($validated);
        return back()->with('success', 'Data perangkat berhasil diperbarui!');
    }

    // TAMBAHKAN FUNGSI DESTROY INI
    public function destroy(Asset $asset)
    {
        $asset->delete();
        return back()->with('success', 'Perangkat berhasil dihapus dari sistem IMUX Corp!');
    }
}