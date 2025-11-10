<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\KategoriBerita; // <-- Penting: Ambil model Kategori
use Illuminate\Support\Str; // <-- Penting: Untuk membuat slug

class BeritaController extends Controller
{
    /**
     * Menampilkan daftar berita
     */
    public function index()
    {
        // Gunakan 'with' untuk eager loading relasi kategoriBerita
        $items = Berita::with('kategoriBerita')
                       ->orderBy('berita_id', 'desc')
                       ->paginate(15);

        return view('pages.berita.index', compact('items'));
    }

    /**
     * Menampilkan form untuk membuat berita baru
     */
    public function create()
    {
        // V Ambil semua kategori untuk ditampilkan di dropdown
        $kategori = KategoriBerita::orderBy('nama', 'asc')->get();
        return view('pages.berita.create', compact('kategori')); // <-- Data dikirim ke view
    }

    /**
     * Menyimpan berita baru ke database
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:beritas,slug',
            'kategori_id' => 'required|integer|exists:kategori_beritas,kategori_id',
            'isi_html' => 'nullable|string',
            'penulis' => 'nullable|string|max:100',
            'status' => 'required|string|in:draft,published', // Sesuaikan status
            'terbit_at' => 'nullable|date',
        ]);

        // Jika slug kosong, buat dari judul
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['judul']);
        }

        Berita::create($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan');
    }

    /**
     * (Opsional) Menampilkan satu berita
     */
    public function show(Berita $beritum)
    {
        // return view('pages.berita.show', ['item' => $beritum]);
    }

    /**
     * Menampilkan form edit
     */
    public function edit(Berita $beritum)
    {
        // V Ambil semua kategori untuk ditampilkan di dropdown
        $kategori = KategoriBerita::orderBy('nama', 'asc')->get();
        return view('pages.berita.edit', [
            'item' => $beritum,
            'kategori' => $kategori // <-- Data dikirim ke view
        ]);
    }

    /**
     * Memperbarui berita
     */
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

    /**
     * Menghapus berita
     */
    public function destroy(Berita $beritum)
    {
        $beritum->delete();
        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus');
    }
}
