<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tanggapan;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;

class TanggapanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Pengaduan $pengaduan)
    {
        $tanggapans = $pengaduan->tanggapans()->latest()->get();
        return view('tanggapans.index', compact('pengaduan', 'tanggapans'));
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
    public function store(Request $request, $pengaduan_id)
    {
        $request->validate([
            'isi_tanggapan' => 'required|string',
            'status' => 'required|in:pending,proses,selesai',
        ]);

        $pengaduan = Pengaduan::findOrFail($pengaduan_id);
        $tanggapan = new Tanggapan();
        $tanggapan->pengaduan_id = $pengaduan->id;
        $tanggapan->user_id = Auth::id(); 
        $tanggapan->isi_tanggapan = $request->isi_tanggapan;
        $tanggapan->save();

        
        $pengaduan->status = $request->status;
        $pengaduan->save();

        return redirect()->back()->with('success', 'Tanggapan berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengaduan $pengaduan, Tanggapan $tanggapan)
    {
        return view('tanggapans.show', compact('pengaduan', 'tanggapan'));
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
    public function destroy(Pengaduan $pengaduan, Tanggapan $tanggapan)
    {
        $tanggapan->delete();
        return redirect()->route('tanggapans.index', $pengaduan)->with('success', 'Tanggapan berhasil dihapus');
    }
}
