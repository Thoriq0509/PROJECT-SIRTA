<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumentasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumentasiController extends Controller
{
    public function index()
    {
        $dokumentasi = Dokumentasi::latest()->get();

        return view('admin.dokumentasi.index', compact('dokumentasi'));
    }

    public function create()
    {
        return view('admin.dokumentasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,webp,mp4,mov,avi,mkv|max:20480',
            'judul_dokumentasi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'nullable|string',
            'link_google_drive' => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('dokumentasi', 'public');
        }

        Dokumentasi::create($validated);

        return redirect()
            ->route('admin.dokumentasi.index')
            ->with('success', 'Dokumentasi berhasil ditambahkan.');
    }

    public function edit(Dokumentasi $dokumentasi)
    {
        return view('admin.dokumentasi.edit', compact('dokumentasi'));
    }

    public function update(Request $request, Dokumentasi $dokumentasi)
    {
        $validated = $request->validate([
            'file' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,mov,avi,mkv|max:20480',
            'judul_dokumentasi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'nullable|string',
            'link_google_drive' => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('file')) {

            if ($dokumentasi->file) {
                Storage::disk('public')->delete($dokumentasi->file);
            }

            $validated['file'] = $request->file('file')->store('dokumentasi', 'public');
        }

        $dokumentasi->update($validated);

        return redirect()
            ->route('admin.dokumentasi.index')
            ->with('success', 'Dokumentasi berhasil diperbarui.');
    }

    public function destroy(Dokumentasi $dokumentasi)
    {
        if ($dokumentasi->file) {
            Storage::disk('public')->delete($dokumentasi->file);
        }

        $dokumentasi->delete();

        return redirect()
            ->route('admin.dokumentasi.index')
            ->with('success', 'Dokumentasi berhasil dihapus.');
    }
}