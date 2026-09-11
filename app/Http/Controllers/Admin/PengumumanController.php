<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::latest()->get();
        return view('admin.pengumuman.index', compact('pengumumans'));
    }

    public function create()
    {
        return view('admin.pengumuman.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required|string|max:255',
            'tanggal' => 'required|date',
            'isi'     => 'nullable|string',
            'gambar'  => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('pengumuman', 'public');
        }

        Pengumuman::create([
            'judul'   => $request->judul,
            'tanggal' => $request->tanggal,
            'isi'     => $request->isi,
            'gambar'  => $path,
            'status'  => 'publish', // Otomatis publish saat dibuat baru
        ]);

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan dan langsung dipublish!');
    }

    public function edit(Pengumuman $pengumuman)
    {
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $request->validate([
            'judul'   => 'required|string|max:255',
            'tanggal' => 'required|date',
            'status'  => 'required|in:publish,draft',
            'isi'     => 'nullable|string',
            'gambar'  => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4|max:2048',
        ]);

        $path = $pengumuman->gambar;
        if ($request->hasFile('gambar')) {
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
            $path = $request->file('gambar')->store('pengumuman', 'public');
        }

        $pengumuman->update([
            'judul'   => $request->judul,
            'tanggal' => $request->tanggal,
            'isi'     => $request->isi,
            'gambar'  => $path,
            'status'  => $request->status,
        ]);

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui!');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        if ($pengumuman->gambar && Storage::disk('public')->exists($pengumuman->gambar)) {
            Storage::disk('public')->delete($pengumuman->gambar);
        }

        $pengumuman->delete();

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus!');
    }
}