<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        // 1. Menghitung Total Pengguna (Kelola User)
        $totalUsers = \App\Models\User::count();

        // 2. Menghitung Total Perangkat (Monitoring Sistem)
        $totalAssets = \App\Models\Asset::count();

        // 3. Menghitung Master Data (Contoh: Kategori & Lokasi)
        // Pastikan Anda sudah memiliki Model Category dan Location
        $totalKategori = \App\Models\Category::count();
        $totalLokasi = \App\Models\Location::count();

        // 4. Mengambil 5 User yang paling baru mendaftar
        $recentUsers = \App\Models\User::orderBy('created_at', 'desc')->take(5)->get();

        // Kirim data ke view dashboard admin
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAssets',
            'totalKategori',
            'totalLokasi',
            'recentUsers'
        ));
    }

    public function userIndex()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
    
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,staff,manajemen',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'User berhasil ditambahkan!');
    }

    public function update(Request $request, User $user) {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:admin,staff,manajemen',
        ]);

        $user->update([
            'name' => $request->name,
            'role' => $request->role,
        ]);

        if ($request->password) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->back()->with('success', 'User berhasil diperbarui!');
    }

    public function destroy(User $user) {
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak bisa menghapus diri sendiri!');
        }
        $user->delete();
        return redirect()->back()->with('success', 'User berhasil dihapus!');
    }
}