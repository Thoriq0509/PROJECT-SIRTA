<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduan = Pengaduan::latest()->get();

        return view('admin.pengaduan.index', compact('pengaduan'));
    }

    public function create()
    {
        return view('admin.pengaduan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,mov,avi,mkv|max:20480',
            'nama_pelapor' => 'required|string|max:255',
            'nomor_hp_pelapor' => 'required|string|max:20',
            'isi_pengaduan' => 'required|string',
            'tanggal_pengaduan' => 'required|date',
            'status' => 'required|in:belum selesai,selesai',
        ]);

        if ($request->hasFile('bukti')) {
            $validated['bukti'] = $request->file('bukti')->store('pengaduan', 'public');
        }

        Pengaduan::create($validated);

        return redirect()
            ->route('admin.pengaduan.index')
            ->with('success', 'Pengaduan berhasil ditambahkan.');
    }

    public function edit(Pengaduan $pengaduan)
    {
        return view('admin.pengaduan.edit', compact('pengaduan'));
    }

    public function update(Request $request, Pengaduan $pengaduan)
    {
        $validated = $request->validate([
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,mov,avi,mkv|max:20480',
            'nama_pelapor' => 'required|string|max:255',
            'nomor_hp_pelapor' => 'required|string|max:20',
            'isi_pengaduan' => 'required|string',
            'tanggal_pengaduan' => 'required|date',
            'status' => 'required|in:belum selesai,selesai',
        ]);

        if ($request->hasFile('bukti')) {

            if ($pengaduan->bukti) {
                Storage::disk('public')->delete($pengaduan->bukti);
            }

            $validated['bukti'] = $request->file('bukti')->store('pengaduan', 'public');
        }

        $pengaduan->update($validated);

        return redirect()
            ->route('admin.pengaduan.index')
            ->with('success', 'Pengaduan berhasil diperbarui.');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        if ($pengaduan->bukti) {
            Storage::disk('public')->delete($pengaduan->bukti);
        }

        $pengaduan->delete();

        return redirect()
            ->route('admin.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }
}