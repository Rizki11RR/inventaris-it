<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaintenanceController extends Controller
{

    public function index()
    {
        // Mengambil data maintenance beserta data aset terkait
        $maintenances = Maintenance::with('asset')->orderBy('tanggal_perawatan', 'desc')->get();
        
        // TAMBAHKAN BARIS INI: Mengambil data aset untuk pilihan di Form Tambah
        $assets = \App\Models\Asset::all(); 
        
        return view('staff.maintenance.history', compact('maintenances', 'assets'));
    }
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'asset_id' => 'required',
            'tanggal_perawatan' => 'required|date',
            'detail_perbaikan' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);

        $data = $request->all();

        // 2. Logika Penangkapan File Upload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            // Membuat nama file unik (waktu saat ini + nama asli file)
            $filename = time() . '_' . $file->getClientOriginalName();
            // Menyimpan file ke folder storage/app/public/kerusakan
            $file->storeAs('kerusakan', $filename, 'public');
            // Memasukkan nama file ke dalam array data untuk disimpan ke database
            $data['dokumentasi_kerusakan'] = $filename;
        }

        // 3. Simpan ke database
        Maintenance::create($data);

        return back()->with('success', 'Histori perawatan berhasil diperbarui!');
    }
}