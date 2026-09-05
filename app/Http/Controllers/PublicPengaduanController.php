<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PublicPengaduanController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,mov,avi,mkv|max:20480',
            'nama_pelapor' => 'required|string|max:255',
            'nomor_hp_pelapor' => 'required|string|max:20',
            'isi_pengaduan' => 'required|string',
        ]);

        if ($request->hasFile('bukti')) {
            $validated['bukti'] = $request
                ->file('bukti')
                ->store('pengaduan', 'public');
        }

        $validated['tanggal_pengaduan'] = now()->toDateString();
        $validated['status'] = 'belum selesai';

        Pengaduan::create($validated);

        return redirect('/#pengaduan')
            ->with('success', 'Pengaduan berhasil dikirim.');
    }
}