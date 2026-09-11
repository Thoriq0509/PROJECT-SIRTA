<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class WargaController extends Controller
{
    // Menampilkan daftar warga
    public function index()
    {
        $wargas = User::where('role', 'warga')->latest()->get();
        return view('admin.warga.index', compact('wargas'));
    }

    // Menampilkan form tambah warga
    public function create()
    {
        return view('admin.warga.create');
    }

    // Proses simpan data warga baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|unique:users,nik',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6',
            'no_hp' => 'nullable|string',
        ]);

        User::create([
            'name' => $request->name,
            'nik' => $request->nik,
            'username' => $request->username,
            // Solusi error: membuat email otomatis karena DB meminta kolom email
            'email' => $request->username . '@warga.sirta', 
            'password' => Hash::make($request->password),
            'role' => 'warga',
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('admin.warga.index')->with('success', 'Akun warga berhasil ditambahkan!');
    }

    // Menampilkan form edit warga
    public function edit(User $warga)
    {
        return view('admin.warga.edit', compact('warga'));
    }

    // Proses update data warga
    public function update(Request $request, User $warga)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => ['required', 'string', Rule::unique('users', 'nik')->ignore($warga->id)],
            'username' => ['required', 'string', Rule::unique('users', 'username')->ignore($warga->id)],
            'password' => 'nullable|string|min:6',
            'no_hp' => 'nullable|string',
        ]);

        $data = [
            'name' => $request->name,
            'nik' => $request->nik,
            'username' => $request->username,
            // Update juga email dummy-nya jika username diubah
            'email' => $request->username . '@warga.sirta',
            'no_hp' => $request->no_hp,
        ];

        // Password hanya di-update jika diisi oleh admin
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $warga->update($data);

        return redirect()->route('admin.warga.index')->with('success', 'Data warga berhasil diperbarui!');
    }

    // Proses hapus data warga
    public function destroy(User $warga)
    {
        $warga->delete();

        return redirect()->route('admin.warga.index')->with('success', 'Akun warga berhasil dihapus!');
    }
}