<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::all();
        return view('admin.locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lokasi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Location::create($validated);
        return redirect()->back()->with('success', 'Data Lokasi berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            'nama_lokasi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $location->update($validated);
        return redirect()->back()->with('success', 'Data Lokasi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->back()->with('success', 'Data Lokasi berhasil dihapus!');
    }
}
