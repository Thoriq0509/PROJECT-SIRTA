<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    public function index()
    {
        // Asumsi data pengaduan dikaitkan dengan user yang login (misal pakai user_id)
        // Atau jika menggunakan nama/no_hp, sesuaikan dengan relasi databasemu.
        $pengaduan = Pengaduan::where('user_id', Auth::id())->latest()->get();
        
        return view('warga.pengaduan.index', compact('pengaduan'));
    }

    public function create()
    {
        return view('warga.pengaduan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori' => 'required|string|in:keamanan,kebersihan,infrastruktur,sosial,lainnya',
            'isi_pengaduan' => 'required|string',
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,mov|max:5120',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['nama_pelapor'] = Auth::user()->name;
        $validated['nomor_hp_pelapor'] = Auth::user()->no_hp ?? '-';
        $validated['tanggal_pengaduan'] = now();
        $validated['status'] = 'diajukan'; // Status awal diajukan

        if ($request->hasFile('bukti')) {
            $validated['bukti'] = $request->file('bukti')->store('pengaduan', 'public');
        }

        Pengaduan::create($validated);

        return redirect()->route('warga.pengaduan.index')->with('success', 'Pengaduan berhasil diajukan!');
    }

    public function edit(Pengaduan $pengaduan)
    {
        // Validasi kepemilikan dan status (hanya boleh edit jika belum diproses/selesai)
        if ($pengaduan->user_id !== Auth::id() || $pengaduan->status === 'selesai' || $pengaduan->status === 'diproses') {
            return redirect()->route('warga.pengaduan.index')->with('error', 'Pengaduan tidak dapat diubah karena sudah diproses atau bukan milik Anda.');
        }

        return view('warga.pengaduan.edit', compact('pengaduan'));
    }

    public function update(Request $request, Pengaduan $pengaduan)
    {
        if ($pengaduan->user_id !== Auth::id() || $pengaduan->status === 'selesai' || $pengaduan->status === 'diproses') {
            return redirect()->route('warga.pengaduan.index')->with('error', 'Aksi ditolak.');
        }

        $validated = $request->validate([
            'kategori' => 'required|string|in:keamanan,kebersihan,infrastruktur,sosial,lainnya',
            'isi_pengaduan' => 'required|string',
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,mov|max:5120',
        ]);

        if ($request->hasFile('bukti')) {
            if ($pengaduan->bukti) {
                Storage::disk('public')->delete($pengaduan->bukti);
            }
            $validated['bukti'] = $request->file('bukti')->store('pengaduan', 'public');
        }

        $pengaduan->update($validated);

        return redirect()->route('warga.pengaduan.index')->with('success', 'Pengaduan berhasil diperbarui!');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        if ($pengaduan->user_id !== Auth::id() || $pengaduan->status === 'selesai' || $pengaduan->status === 'diproses') {
            return redirect()->route('warga.pengaduan.index')->with('error', 'Pengaduan tidak dapat dihapus.');
        }

        if ($pengaduan->bukti) {
            Storage::disk('public')->delete($pengaduan->bukti);
        }

        $pengaduan->delete();

        return redirect()->route('warga.pengaduan.index')->with('success', 'Pengaduan berhasil dihapus!');
    }
}