<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = Status::all();
        return view('admin.statuses.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_status' => 'required|string|max:255',
            'warna' => 'required|string',
        ]);

        Status::create($validated);
        return redirect()->back()->with('success', 'Status perangkat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Status $status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Status $status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Status $status)
    {
        $validated = $request->validate([
            'nama_status' => 'required|string|max:255',
            'warna' => 'required|string',
        ]);

        $status->update($validated);
        return redirect()->back()->with('success', 'Status perangkat berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Status $status)
    {
        $status->delete();
        return redirect()->back()->with('success', 'Status perangkat berhasil dihapus!');
    }
}
