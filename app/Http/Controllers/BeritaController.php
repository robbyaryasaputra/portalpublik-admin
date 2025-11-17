<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // <-- Pastikan ini ada
use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /**
     * Menampilkan daftar berita
     */
    // V 1. Tambahkan (Request $request)
    public function index(Request $request)
    {
        // V 2. Tentukan kolom untuk filter dan search
        $filterableColumns = ['kategori_id', 'status'];
        $searchableColumns = ['judul', 'penulis']; // Anda bisa tambahkan 'isi_html' jika mau

        // V 3. Ambil data untuk dropdown filter
        $kategori = KategoriBerita::orderBy('nama', 'asc')->get();

        // V 4. Terapkan scope dan withQueryString()
        $items = Berita::with('kategoriBerita')
                       ->filter($request, $filterableColumns)    // <-- Tambahkan ini
                       ->search($request, $searchableColumns)   // <-- Tambahkan ini
                       ->orderBy('berita_id', 'desc')
                       ->paginate(15)
                       ->withQueryString(); // <-- Tambahkan ini (PENTING untuk pagination)

        // V 5. Kirim data 'kategori' ke view
        return view('pages.berita.index', compact('items', 'kategori'));
    }

    /**
     * Menampilkan form untuk membuat berita baru
     */
    public function create()
    {
        // ... (Tidak ada perubahan)
        $kategori = KategoriBerita::orderBy('nama', 'asc')->get();
        return view('pages.berita.create', compact('kategori'));
    }

    /**
     * Menyimpan berita baru ke database
     */
    public function store(Request $request)
    {
        // ... (Tidak ada perubahan)
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:beritas,slug',
            'kategori_id' => 'required|integer|exists:kategori_beritas,kategori_id',
            'isi_html' => 'nullable|string',
            'penulis' => 'nullable|string|max:100',
            'status' => 'required|string|in:draft,published',
            'terbit_at' => 'nullable|date',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['judul']);
        }

        Berita::create($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan');
    }

    // ... (Method show, edit, update, destroy tidak perlu diubah)
    // ...
    public function edit(Berita $beritum)
    {
        $kategori = KategoriBerita::orderBy('nama', 'asc')->get();
        return view('pages.berita.edit', [
            'item' => $beritum,
            'kategori' => $kategori
        ]);
    }

    public function update(Request $request, Berita $beritum)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:beritas,slug,' . $beritum->berita_id . ',berita_id',
            'kategori_id' => 'required|integer|exists:kategori_beritas,kategori_id',
            'isi_html' => 'nullable|string',
            'penulis' => 'nullable|string|max:100',
            'status' => 'required|string|in:draft,published',
            'terbit_at' => 'nullable|date',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['judul']);
        }

        $beritum->update($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy(Berita $beritum)
    {
        $beritum->delete();
        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus');
    }
}
