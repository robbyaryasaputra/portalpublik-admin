<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::with('kategori')
                        ->orderBy('berita_id', 'desc')
                        ->paginate(10);
        return view('pages.berita.index', compact('beritas'));
    }

    public function create()
    {
        $kategoris = KategoriBerita::orderBy('nama')->get();
        return view('pages.berita.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kategori_id' => 'required|exists:kategori_beritas,kategori_id',
            'judul' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:beritas,slug',
            'isi_html' => 'required|string',
            'penulis' => 'nullable|string|max:100',
            'status' => 'required|in:draft,published',
            'terbit_at' => 'nullable|date',
        ]);

        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['judul']);
        }

        // Set terbit_at if status is published and terbit_at is not set
        if ($data['status'] === 'published' && empty($data['terbit_at'])) {
            $data['terbit_at'] = now();
        }

        Berita::create($data);

        return redirect()
            ->route('berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function show(Berita $berita)
    {

    }

    public function edit(Berita $berita)
    {
        $kategoris = KategoriBerita::orderBy('nama')->get();
        return view('pages.berita.edit', compact('berita', 'kategoris'));
    }

    public function update(Request $request, Berita $berita)
    {
        $data = $request->validate([
            'kategori_id' => 'required|exists:kategori_beritas,kategori_id',
            'judul' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:beritas,slug,' . $berita->berita_id . ',berita_id',
            'isi_html' => 'required|string',
            'penulis' => 'nullable|string|max:100',
        ]);

        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['judul']);
        }

        // Preserve existing status and terbit_at
        $data['status'] = $berita->status;
        $data['terbit_at'] = $berita->terbit_at;

        $berita->update($data);

        return redirect()
            ->route('berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        $berita->delete();
        return redirect()
            ->route('berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    // No additional methods needed
}
