<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\GaleriController;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $galeris = Galeri::when($search, function ($query, $search) {
                        return $query->where('judul', 'like', "%{$search}%");
                    })
                    ->withCount('photos') // Menghitung jumlah foto di setiap album
                    ->orderBy('created_at', 'desc')
                    ->paginate(10)
                    ->withQueryString();

        return view('pages.galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('pages.galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'photos.*'  => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi tiap file
        ]);

        // 1. Buat Album Galeri
        $galeri = Galeri::create($request->only(['judul', 'deskripsi']));

        // 2. Upload Foto (Multiple)
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

        return redirect()->route('galeri.index')->with('success', 'Album galeri berhasil dibuat.');
    }

    public function edit(Galeri $galeri)
    {
        return view('pages.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'photos.*'  => 'image|max:2048',
        ]);

        // Update Info Dasar
        $galeri->update($request->only(['judul', 'deskripsi']));

        // Tambah Foto Baru (Jika ada)
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

    public function destroy(Galeri $galeri)
    {
        // 1. Hapus File Fisik & Record Media
        foreach ($galeri->photos as $photo) {
            if ($photo->file_url && Storage::disk('public')->exists($photo->file_url)) {
                Storage::disk('public')->delete($photo->file_url);
            }
            $photo->delete();
        }

        // 2. Hapus Album
        $galeri->delete();
        return redirect()->route('galeri.index')->with('success', 'Album galeri dihapus.');
    }
}