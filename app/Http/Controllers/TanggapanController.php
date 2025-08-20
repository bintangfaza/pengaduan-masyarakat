<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tanggapan;

class TanggapanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Tanggapan::all();
        return view('tanggapan.index', compact('tanggapans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tanggapan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pengaduan_id' => 'required|exists:pengaduans,id',
            'user_id' => 'required|exists:users,id',
            'tanggapan' => 'required|string|max:1000',
            'tanggal_tanggapan' => 'required|date',
        ]);

        Tanggapan::create($validated);

        return redirect()->route('tanggapan.index')->with('success', 'Tanggapan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('tanggapan.show', compact('tanggapan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('tanggapan.edit', compact('tanggapan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'pengaduan_id' => 'required|exists:pengaduans,id',
            'user_id' => 'required|exists:users,id',
            'tanggapan' => 'required|string|max:1000',
            'tanggal_tanggapan' => 'required|date',
        ]);

        Tanggapan::where('id', $id)->update($validated);

        return redirect()->route('tanggapan.index')->with('success', 'Tanggapan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tanggapan $tanggapan)
    {
        $tanggapan->delete();
        return redirect()->route('tanggapan.index')->with('success', 'Tanggapan deleted successfully.');
    }
   
}
