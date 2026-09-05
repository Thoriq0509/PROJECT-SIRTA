<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::latest()->get();

        return view('admin.pengumuman.index', compact('pengumuman'));
    }

    public function create()
    {
        return view('admin.pengumuman.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        Pengumuman::create($validated);

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function edit(Pengumuman $pengumuman)
    {
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        $pengumuman->update($validated);

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }
}