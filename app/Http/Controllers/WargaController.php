<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WargaController extends Controller
{
    /**
     * Menampilkan daftar warga.
     */
    public function index(Request $request)
    {
        $filterableColumns = ['jenis_kelamin'];
        $searchableColumns = ['nama', 'no_ktp', 'email', 'telp'];

        $wargas = Warga::filter($request, $filterableColumns)
                        ->search($request, $searchableColumns)
                        ->orderBy('created_at', 'desc')
                        ->paginate(20)
                        ->withQueryString();

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
            'foto'          => 'nullable|image|max:2048', // Validasi foto
        ]);

        // Simpan data teks dulu
        $warga = Warga::create($data);

        // LOGIC UPLOAD FOTO
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('uploads/wargas', 'public');
            
            Media::create([
                'ref_table' => 'wargas',
                'ref_id'    => $warga->warga_id,
                'file_url'  => $path,
                'caption'   => 'avatar',
                'mime_type' => $request->file('foto')->getClientMimeType(),
            ]);
        }

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail warga.
     */
    public function show(Warga $warga)
    {
        return view('pages.warga.show', ['item' => $warga]);
    }

    /**
     * Menampilkan form edit.
     */
    public function edit(Warga $warga)
    {
        return view('pages.warga.edit', compact('warga'));
    }

    /**
     * Memperbarui data warga.
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
            'foto'          => 'nullable|image|max:2048',
        ]);

        // Update data text (kecuali foto karena foto ditangani manual)
        $warga->update($request->except(['foto']));

        // LOGIC UPDATE FOTO
        if ($request->hasFile('foto')) {
            // 1. Cari & Hapus foto lama
            $oldPhoto = $warga->media()->where('caption', 'avatar')->first();
            
            if ($oldPhoto) {
                if (Storage::disk('public')->exists($oldPhoto->file_url)) {
                    Storage::disk('public')->delete($oldPhoto->file_url);
                }
                $oldPhoto->delete();
            }

            // 2. Upload baru
            $path = $request->file('foto')->store('uploads/wargas', 'public');
            Media::create([
                'ref_table' => 'wargas',
                'ref_id'    => $warga->warga_id,
                'file_url'  => $path,
                'caption'   => 'avatar',
                'mime_type' => $request->file('foto')->getClientMimeType(),
            ]);
        }

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui.');
    }

    /**
     * Menghapus data warga beserta fotonya.
     */
    public function destroy(Warga $warga)
    {
        // 1. Hapus foto fisik & record di database media
        foreach ($warga->media as $media) {
            if (Storage::disk('public')->exists($media->file_url)) {
                Storage::disk('public')->delete($media->file_url);
            }
            $media->delete();
        }
        
        // 2. Hapus data warga
        $warga->delete();

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus.');
    }
}