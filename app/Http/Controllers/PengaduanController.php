<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Support\Str;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{

    $query = Pengaduan::query();

    if ($request->has('status') && $request->status != '') {
        $query->where('status', $request->status);
    }

    $pengaduans = $query->with('user')
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view('pengaduans.index', compact('pengaduans'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pengaduans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'foto' => 'nullable|image|max:2048',
            'kategori' => 'required|string|max:100',
        ]);

        $pengaduan = new Pengaduan();
        $pengaduan->judul = $request->judul;
        $pengaduan->isi = $request->isi;
        $pengaduan->kategori = $request->kategori;
        $pengaduan->user_id = auth()->id();

        // Simpan file foto
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('fotos', $imageName, 'public');
            $pengaduan->foto = $imagePath; 
        }

        $pengaduan->save();

        return redirect()->route('pengaduans.index')
            ->with('success', 'Pengaduan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        return view('pengaduans.show', compact('pengaduan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        if ($pengaduan->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            return redirect()->route('pengaduans.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit pengaduan ini.');
        }

        return view('pengaduans.edit', compact('pengaduan'));
    }

    public function update(Request $request, string $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        if ($pengaduan->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            return redirect()->route('pengaduans.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengupdate pengaduan ini.');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'foto' => 'nullable|image|max:2048',
            'kategori' => 'required|string|max:100',
        ]);

        $pengaduan->judul = $request->judul;
        $pengaduan->isi = $request->isi;
        $pengaduan->kategori = $request->kategori;

        // Update foto jika ada
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('fotos', $imageName, 'public');
            $pengaduan->foto = $imagePath;
        }

        $pengaduan->save();

        return redirect()->route('pengaduans.index')
            ->with('success', 'Pengaduan berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        if ($pengaduan->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            return redirect()->route('pengaduans.index')
                ->with('error', 'Anda tidak memiliki izin untuk menghapus pengaduan ini.');
        }
        if ($pengaduan->status === 'proses') {
            return redirect()->route('pengaduans.index')
                ->with('error', 'Hanya pengaduan sedang diproses jadi tidak bisa dihapus.');
        }

        $pengaduan->delete();

        return redirect()->route('pengaduans.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }

    public function destroyRiwayat(string $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        if ($pengaduan->user_id !== auth()->id()) {
            return redirect()->route('warga.riwayat')
                ->with('error', 'Anda tidak memiliki izin untuk menghapus pengaduan ini.');
        }
        if ($pengaduan->status === 'proses') {
            return redirect()->route('warga.riwayat')
                ->with('error', 'Hanya pengaduan sedang diproses jadi tidak bisa dihapus.');
        }

        $pengaduan->delete();

        return redirect()->route('warga.riwayat')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }

    public function riwayat()
    {
        $riwayat = Pengaduan::with('tanggapans')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('warga.riwayat', compact('riwayat'));
    }
}
