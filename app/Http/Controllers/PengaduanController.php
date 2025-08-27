<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengaduans = Pengaduan::all();
        return view('pengaduans.index' , compact('pengaduans'));
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

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/fotos');
            $pengaduan->foto = basename($path);
        }

        $pengaduan->save();

        return redirect()->route('pengaduans.index')->with('success', 'Pengaduan berhasil dibuat.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
