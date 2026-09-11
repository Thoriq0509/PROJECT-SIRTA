<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengurusController extends Controller
{
    public function index()
    {
        $pengurus = Pengurus::latest()->get();

        return view('admin.pengurus.index', compact('pengurus'));
    }

    public function create()
    {
        return view('admin.pengurus.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'jabatan' => 'required|string|max:255',
            'nama_pengurus' => 'required|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
        ]);

        // Tangani jika no_telepon kosong agar tersimpan sebagai null di database
        if (empty($validated['no_telepon'])) {
            $validated['no_telepon'] = null;
        }

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('pengurus', 'public');
        }

        Pengurus::create($validated);

        return redirect()
            ->route('admin.pengurus.index')
            ->with('success', 'Data pengurus berhasil ditambahkan.');
    }

    public function edit(Pengurus $pengurus)
    {
        return view('admin.pengurus.edit', compact('pengurus'));
    }

    public function update(Request $request, Pengurus $pengurus)
    {
        $validated = $request->validate([
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'jabatan' => 'required|string|max:255',
            'nama_pengurus' => 'required|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
        ]);

        // Tangani jika no_telepon kosong agar tersimpan sebagai null di database
        if (empty($validated['no_telepon'])) {
            $validated['no_telepon'] = null;
        }

        if ($request->hasFile('foto')) {

            if ($pengurus->foto) {
                Storage::disk('public')->delete($pengurus->foto);
            }

            $validated['foto'] = $request->file('foto')->store('pengurus', 'public');
        }

        $pengurus->update($validated);

        return redirect()
            ->route('admin.pengurus.index')
            ->with('success', 'Data pengurus berhasil diperbarui.');
    }

    public function destroy(Pengurus $pengurus)
    {
        if ($pengurus->foto) {
            Storage::disk('public')->delete($pengurus->foto);
        }

        $pengurus->delete();

        return redirect()
            ->route('admin.pengurus.index')
            ->with('success', 'Data pengurus berhasil dihapus.');
    }
}