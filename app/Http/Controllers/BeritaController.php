<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\KategoriBerita;
use App\Models\Media;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['kategori_id', 'status'];
        $searchableColumns = ['judul', 'penulis'];
        $kategori = KategoriBerita::orderBy('nama', 'asc')->get();

        $items = Berita::with('kategoriBerita')
                       ->filter($request, $filterableColumns)
                       ->search($request, $searchableColumns)
                       ->orderBy('berita_id', 'desc')
                       ->paginate(10)
                       ->withQueryString();

        return view('pages.berita.index', compact('items', 'kategori'));
    }

    public function create()
    {
        $kategori = KategoriBerita::orderBy('nama', 'asc')->get();
        return view('pages.berita.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'       => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:beritas,slug',
            'kategori_id' => 'required|integer|exists:kategori_beritas,kategori_id',
            'isi_html'    => 'nullable|string',
            'penulis'     => 'nullable|string|max:100',
            'status'      => 'required|string|in:draft,published',
            'terbit_at'   => 'nullable|date',
            'cover_image' => 'nullable|image|max:2048', // Cover (Single)
            'gallery.*'   => 'nullable|image|max:2048', // Galeri (Multiple)
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['judul']);
        }

        $berita = Berita::create($data);

        // 1. UPLOAD COVER (Single)
        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('uploads/beritas', 'public');
            Media::create([
                'ref_table' => 'beritas',
                'ref_id'    => $berita->berita_id,
                'file_url'  => $path,
                'caption'   => 'cover_image',
                'mime_type' => $request->file('cover_image')->getClientMimeType(),
            ]);
        }

        // 2. UPLOAD GALERI (Multiple) - BARU
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $path = $file->store('uploads/beritas', 'public');
                Media::create([
                    'ref_table' => 'beritas',
                    'ref_id'    => $berita->berita_id,
                    'file_url'  => $path,
                    'caption'   => 'gallery', // Bedakan captionnya
                    'mime_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan');
    }

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
            'judul'       => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:beritas,slug,' . $beritum->berita_id . ',berita_id',
            'kategori_id' => 'required|integer|exists:kategori_beritas,kategori_id',
            'isi_html'    => 'nullable|string',
            'penulis'     => 'nullable|string|max:100',
            'status'      => 'required|string|in:draft,published',
            'terbit_at'   => 'nullable|date',
            'cover_image' => 'nullable|image|max:2048',
            'gallery.*'   => 'nullable|image|max:2048',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['judul']);
        }

        $beritum->update(collect($data)->except(['cover_image', 'gallery'])->toArray());

        // 1. UPDATE COVER (Ganti foto lama)
        if ($request->hasFile('cover_image')) {
            $oldMedia = $beritum->media()->where('caption', 'cover_image')->first();
            if ($oldMedia) {
                if (Storage::disk('public')->exists($oldMedia->file_url)) {
                    Storage::disk('public')->delete($oldMedia->file_url);
                }
                $oldMedia->delete();
            }

            $path = $request->file('cover_image')->store('uploads/beritas', 'public');
            Media::create([
                'ref_table' => 'beritas',
                'ref_id'    => $beritum->berita_id,
                'file_url'  => $path,
                'caption'   => 'cover_image',
                'mime_type' => $request->file('cover_image')->getClientMimeType(),
            ]);
        }

        // 2. UPDATE GALERI (Tambah foto baru, foto lama tetap ada)
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $path = $file->store('uploads/beritas', 'public');
                Media::create([
                    'ref_table' => 'beritas',
                    'ref_id'    => $beritum->berita_id,
                    'file_url'  => $path,
                    'caption'   => 'gallery',
                    'mime_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy(Berita $beritum)
    {
        foreach ($beritum->media as $m) {
            if ($m->file_url && Storage::disk('public')->exists($m->file_url)) {
                Storage::disk('public')->delete($m->file_url);
            }
            $m->delete();
        }
        $beritum->delete();
        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus');
    }
}