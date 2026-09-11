<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::latest()->get();

        return view('admin.kegiatan.index', compact('kegiatan'));
    }

    public function create()
    {
        return view('admin.kegiatan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan'     => 'required|string|max:255',
            'tanggal'           => 'required|date',
            'waktu_pelaksanaan' => 'required',
            'jam_selesai'       => 'nullable',
            'lokasi'            => 'required|string|max:255',
            'status'            => 'nullable|string|in:Mendatang,Berlangsung,Selesai',
        ]);

        Kegiatan::create($validated);

        return redirect()
            ->route('admin.kegiatan.index')
            ->with('success', 'Jadwal kegiatan berhasil ditambahkan.');
    }

    public function edit(Kegiatan $kegiatan)
    {
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $validated = $request->validate([
            'nama_kegiatan'     => 'required|string|max:255',
            'tanggal'           => 'required|date',
            'waktu_pelaksanaan' => 'required',
            'jam_selesai'       => 'nullable',
            'lokasi'            => 'required|string|max:255',
            'status'            => 'nullable|string|in:Mendatang,Berlangsung,Selesai',
        ]);

        // Tangani jika status dikosongkan agar tersimpan sebagai null di database
        if (empty($validated['status'])) {
            $validated['status'] = null;
        }

        $kegiatan->update($validated);

        return redirect()
            ->route('admin.kegiatan.index')
            ->with('success', 'Jadwal kegiatan berhasil diperbarui.');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();

        return redirect()
            ->route('admin.kegiatan.index')
            ->with('success', 'Jadwal kegiatan berhasil dihapus.');
    }
}