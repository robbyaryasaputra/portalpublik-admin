<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriBerita;

class KategoriBeritaController extends Controller
{
   public function index(Request $request)
    {
        $filterableColumns = [];
        $searchableColumns = ['nama', 'deskripsi']; // Kolom yang ingin dicari

        // V 3. Terapkan scope dan withQueryString()
        $items = KategoriBerita::filter($request, $filterableColumns) // <-- Tambahkan ini
                             ->search($request, $searchableColumns) // <-- Tambahkan ini
                             ->orderBy('kategori_id', 'desc')
                             ->paginate(15)
                             ->withQueryString(); // <-- Tambahkan ini (PENTING)

        return view('pages.kategori-berita.index', compact('items'));
    }
    // Menampilkan form untuk membuat kategori baru
    public function create()
    {
        return view('pages.kategori-berita.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:191',
            'slug' => 'nullable|string|max:191|unique:kategori_beritas,slug',
            'deskripsi' => 'nullable|string',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = \Str::slug($data['nama']);
        }

        KategoriBerita::create($data);

        return redirect()->route('kategori-berita.index')->with('success', 'Kategori berita berhasil ditambahkan');
    }

    // Menampilkan satu kategori
    public function show(KategoriBerita $kategori_beritum)
    {
        return view('pages.kategori-berita.show', ['item' => $kategori_beritum]);
    }

    // Menampilkan form edit
    public function edit(KategoriBerita $kategori_beritum)
    {
        return view('pages.kategori-berita.edit', ['item' => $kategori_beritum]);
    }

    // Memperbarui kategori
    public function update(Request $request, KategoriBerita $kategori_beritum)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:191',
            'slug' => 'nullable|string|max:191|unique:kategori_beritas,slug,' . $kategori_beritum->kategori_id . ',kategori_id',
            'deskripsi' => 'nullable|string',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = \Str::slug($data['nama']);
        }

    $kategori_beritum->update($data);

        return redirect()->route('kategori-berita.index')->with('success', 'Kategori berita berhasil diperbarui');
    }

    // Menghapus kategori
    public function destroy(KategoriBerita $kategori_beritum)
    {
        $kategori_beritum->delete();
        return redirect()->route('kategori-berita.index')->with('success', 'Kategori berita berhasil dihapus');
    }
}
