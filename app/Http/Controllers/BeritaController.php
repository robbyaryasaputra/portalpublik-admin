<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\KategoriBerita;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['kategori_id', 'status'];
        $searchableColumns = ['judul', 'penulis'];
        
        $kategori = KategoriBerita::orderBy('nama', 'asc')->get();

        $items = Berita::with(['kategoriBerita', 'media'])
                       ->filter($request, $filterableColumns)
                       ->search($request, $searchableColumns)
                       ->orderBy('created_at', 'desc')
                       ->paginate(20)
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
            'kategori_id' => 'required|integer',
            'isi_html'    => 'required|string',
            'penulis'     => 'required|string|max:100',
            'status'      => 'required|in:draft,published',
            'terbit_at'   => 'nullable|date',
            'cover_image' => 'nullable|image|max:2048', // Validasi Cover
            'gallery.*'   => 'nullable|image|max:2048', // Validasi Galeri
        ]);

        // Buat Slug otomatis
        $data['slug'] = Str::slug($request->judul) . '-' . time();
        
        // Simpan Data Berita
        $beritaData = collect($data)->except(['cover_image', 'gallery'])->toArray();
        $berita = Berita::create($beritaData);

        // 1. Simpan COVER (Single)
        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('uploads/beritas', 'public');
            Media::create([
                'ref_table' => 'berita',
                'ref_id'    => $berita->berita_id,
                'file_url'  => $path,
                'caption'   => 'cover_image',
                'mime_type' => $request->file('cover_image')->getClientMimeType(),
            ]);
        }

        // 2. Simpan GALERI (Multiple)
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $path = $file->store('uploads/beritas', 'public');
                Media::create([
                    'ref_table' => 'berita',
                    'ref_id'    => $berita->berita_id,
                    'file_url'  => $path,
                    'caption'   => 'gallery',
                    'mime_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diterbitkan.');
    }

    public function show($id)
    {
        $berita = Berita::with(['media', 'kategoriBerita'])->findOrFail($id);
        return view('pages.berita.show', compact('berita'));
    }

    public function edit($id)
    {
        // Parameter di route resource defaultnya adalah nama model ('beritum' atau 'berita')
        // Kita tangkap ID-nya manual agar aman
        $item = Berita::with(['media', 'kategoriBerita'])->findOrFail($id);
        $kategori = KategoriBerita::orderBy('nama', 'asc')->get();
        
        return view('pages.berita.edit', compact('item', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $data = $request->validate([
            'judul'       => 'required|string|max:255',
            'kategori_id' => 'required|integer',
            'isi_html'    => 'required|string',
            'penulis'     => 'required|string|max:100',
            'status'      => 'required|in:draft,published',
            'terbit_at'   => 'nullable|date',
            'cover_image' => 'nullable|image|max:2048',
            'gallery.*'   => 'nullable|image|max:2048',
        ]);

        $berita->update(collect($data)->except(['cover_image', 'gallery'])->toArray());

        // 1. Update COVER (Hapus lama, upload baru)
        if ($request->hasFile('cover_image')) {
            $oldCover = $berita->media()->where('caption', 'cover_image')->first();
            if ($oldCover) {
                if (Storage::disk('public')->exists($oldCover->file_url)) {
                    Storage::disk('public')->delete($oldCover->file_url);
                }
                $oldCover->delete();
            }

            $path = $request->file('cover_image')->store('uploads/beritas', 'public');
            Media::create([
                'ref_table' => 'berita',
                'ref_id'    => $berita->berita_id,
                'file_url'  => $path,
                'caption'   => 'cover_image',
                'mime_type' => $request->file('cover_image')->getClientMimeType(),
            ]);
        }

        // 2. Tambah GALERI Baru (Append)
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $path = $file->store('uploads/beritas', 'public');
                Media::create([
                    'ref_table' => 'berita',
                    'ref_id'    => $berita->berita_id,
                    'file_url'  => $path,
                    'caption'   => 'gallery',
                    'mime_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $berita = Berita::with('media')->findOrFail($id);

        // Hapus semua media terkait
        foreach ($berita->media as $m) {
            if ($m->file_url && Storage::disk('public')->exists($m->file_url)) {
                Storage::disk('public')->delete($m->file_url);
            }
            $m->delete();
        }

        $berita->delete();
        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}