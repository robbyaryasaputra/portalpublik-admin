<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request; // V 1. Pastikan 'Request' di-import

class WargaController extends Controller
{
    /**
     * Menampilkan daftar warga.
     */
    // V 2. Tambahkan (Request $request) pada method index
    public function index(Request $request)
    {
        // V 3. Tentukan kolom untuk filter dan search
        // Kita akan filter berdasarkan 'jenis_kelamin', mirip 'gender' di Pelanggan
        $filterableColumns = ['jenis_kelamin'];
        $searchableColumns = ['nama', 'no_ktp', 'email', 'telp']; // Kolom yang ingin dicari

        // V 4. Terapkan scope, paginate, dan withQueryString
        $wargas = Warga::filter($request, $filterableColumns)
                        ->search($request, $searchableColumns)
                        ->orderBy('created_at', 'desc')
                        ->paginate(20)
                        ->withQueryString(); // <-- PENTING agar filter tidak hilang saat ganti halaman

        return view('pages.warga.index', compact('wargas'));
    }

    /**
     * Menampilkan form tambah warga baru.
     */
    public function create()
    {
        return view('pages.warga.create');
    }

    /**
     * Menyimpan warga baru ke database.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'no_ktp'        => 'required|string|max:50|unique:wargas,no_ktp',
            'nama'          => 'required|string|max:255',
            'jenis_kelamin' => 'nullable|string|in:Laki-laki,Perempuan',
            'agama'         => 'nullable|string|max:50',
            'pekerjaan'     => 'nullable|string|max:100',
            'telp'          => 'nullable|string|max:20',
            'email'         => 'nullable|email|max:255|unique:wargas,email',
        ]);

        Warga::create($data);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit
     */
    public function edit(Warga $warga)
    {
        return view('pages.warga.edit', compact('warga'));
    }

    /**
     * Memperbarui data warga di database.
     */
    public function update(Request $request, Warga $warga)
    {
        $data = $request->validate([
            'no_ktp'        => 'required|string|max:50|unique:wargas,no_ktp,' . $warga->warga_id . ',warga_id',
            'nama'          => 'required|string|max:255',
            'jenis_kelamin' => 'nullable|string|in:Laki-laki,Perempuan',
            'agama'         => 'nullable|string|max:50',
            'pekerjaan'     => 'nullable|string|max:100',
            'telp'          => 'nullable|string|max:20',
            'email'         => 'nullable|email|max:255|unique:wargas,email,' . $warga->warga_id . ',warga_id',
        ]);

        $warga->update($data);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diupdate.');
    }

    /**
     * Menghapus data warga dari database.
     */
    public function destroy(Warga $warga)
    {
        $warga->delete();
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus.');
    }
}
