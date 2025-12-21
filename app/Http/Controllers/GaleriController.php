<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    /**
     * Menampilkan daftar album (Index)
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $galeris = Galeri::query()
            ->when($search, function ($query, $search) {
                return $query->where('judul', 'like', "%{$search}%");
            })
            ->withCount('photos') 
            ->with('photos')
            ->orderBy('created_at', 'desc')
            ->paginate(30)
            ->withQueryString();

        return view('pages.galeri.index', compact('galeris'));
    }

    /**
     * Form Tambah Album
     */
    public function create()
    {
        return view('pages.galeri.create');
    }

    /**
     * Simpan Album Baru & Upload Foto
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'photos.*'  => 'image|mimes:jpeg,png,jpg,gif|max:5120', // Max 5MB per file
        ]);

        // 1. Simpan Data Album
        $galeri = Galeri::create([
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi
        ]);

        // 2. Proses Upload Banyak Foto
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('uploads/galeri', 'public');

                Media::create([
                    'ref_table' => 'galeris', // Penanda tabel
                    'ref_id'    => $galeri->galeri_id,
                    'file_url'  => $path,
                    'caption'   => 'gallery_item',
                    'mime_type' => $photo->getClientMimeType(),
                ]);
            }
        }

        return redirect()->route('galeri.index')->with('success', 'Album galeri berhasil dibuat.');
    }

    /**
     * Lihat Detail Album
     */
    public function show($id)
    {
        $galeri = Galeri::with('photos')->findOrFail($id);
        return view('pages.galeri.show', compact('galeri'));
    }

    /**
     * Form Edit Album
     */
    public function edit($id)
    {
        $galeri = Galeri::with('photos')->findOrFail($id);
        return view('pages.galeri.edit', compact('galeri'));
    }

    /**
     * Update Album & Tambah Foto Baru
     */
    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'photos.*'  => 'image|max:5120',
        ]);

        // 1. Update Info Teks
        $galeri->update($request->only(['judul', 'deskripsi']));

        // 2. Tambah Foto Baru (Append)
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('uploads/galeri', 'public');

                Media::create([
                    'ref_table' => 'galeris',
                    'ref_id'    => $galeri->galeri_id,
                    'file_url'  => $path,
                    'caption'   => 'gallery_item',
                    'mime_type' => $photo->getClientMimeType(),
                ]);
            }
        }

        return redirect()->route('galeri.index')->with('success', 'Album galeri diperbarui.');
    }

    /**
     * Hapus Album & Semua Fotonya
     */
    public function destroy($id)
    {
        $galeri = Galeri::with('photos')->findOrFail($id);

        // 1. Hapus File Fisik & Record di Tabel Media
        foreach ($galeri->photos as $photo) {
            if ($photo->file_url && Storage::disk('public')->exists($photo->file_url)) {
                Storage::disk('public')->delete($photo->file_url);
            }
            $photo->delete();
        }

        // 2. Hapus Album
        $galeri->delete();

        return redirect()->route('galeri.index')->with('success', 'Album dan semua foto berhasil dihapus.');
    }
}
