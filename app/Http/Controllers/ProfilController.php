<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['provinsi'];
        $searchableColumns = ['nama_desa', 'kecamatan', 'kabupaten', 'email', 'telepon'];
        $provinsi = Profil::distinct()->orderBy('provinsi', 'asc')->pluck('provinsi');

        $profils = Profil::filter($request, $filterableColumns)
                        ->search($request, $searchableColumns)
                        ->orderBy('created_at', 'desc')
                        ->paginate(10)
                        ->withQueryString();

        return view('pages.profil.index', compact('profils', 'provinsi'));
    }

    public function create()
    {
        return view('pages.profil.create');
    }

    public function store(Request $request)
    {
        // Validasi
        $data = $request->validate([
            'nama_desa'     => 'required|string|max:100',
            'kecamatan'     => 'nullable|string|max:100',
            'kabupaten'     => 'nullable|string|max:100',
            'provinsi'      => 'nullable|string|max:100',
            'alamat_kantor' => 'nullable|string',
            'email'         => 'nullable|email|max:100',
            'telepon'       => 'nullable|string|max:20',
            'visi'          => 'nullable|string',
            'misi'          => 'nullable|string',
            'logo'          => 'nullable|image|max:2048', // Hanya Validasi Logo
        ]);

        // Simpan Data Profil Utama
        $profil = Profil::create($data);

        // PROSES UPLOAD LOGO (Single)
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('uploads/profils', 'public');
            Media::create([
                'ref_table' => 'profils',
                'ref_id'    => $profil->profil_id,
                'file_url'  => $path,
                'caption'   => 'logo', 
                'mime_type' => $request->file('logo')->getClientMimeType(),
            ]);
        }

        return redirect()->route('profil.index')->with('success', 'Profil berhasil ditambahkan.');
    }

    public function edit(Profil $profil)
    {
        return view('pages.profil.edit', compact('profil'));
    }

    public function update(Request $request, Profil $profil)
    {
        $data = $request->validate([
            'nama_desa'     => 'required|string|max:100',
            'kecamatan'     => 'nullable|string|max:100',
            'kabupaten'     => 'nullable|string|max:100',
            'provinsi'      => 'nullable|string|max:100',
            'alamat_kantor' => 'nullable|string',
            'email'         => 'nullable|email|max:100|unique:profils,email,' . $profil->profil_id . ',profil_id',
            'telepon'       => 'nullable|string|max:20',
            'visi'          => 'nullable|string',
            'misi'          => 'nullable|string',
            'logo'          => 'nullable|image|max:2048',
        ]);

        $profil->update($request->except(['logo']));

        // UPDATE LOGO (Single)
        if ($request->hasFile('logo')) {
            // Cari logo lama
            $oldLogo = $profil->media()->where('caption', 'logo')->first();
            
            // Jika ada, hapus file fisiknya & datanya
            if ($oldLogo) {
                if (Storage::disk('public')->exists($oldLogo->file_url)) {
                    Storage::disk('public')->delete($oldLogo->file_url);
                }
                $oldLogo->delete();
            }

            // Upload baru
            $path = $request->file('logo')->store('uploads/profils', 'public');
            Media::create([
                'ref_table' => 'profils',
                'ref_id'    => $profil->profil_id,
                'file_url'  => $path,
                'caption'   => 'logo',
                'mime_type' => $request->file('logo')->getClientMimeType(),
            ]);
        }

        return redirect()->route('profil.index')->with('success', 'Profil berhasil diupdate.');
    }

    public function destroy(Profil $profil)
    {
        // Hapus semua media terkait
        foreach ($profil->media as $m) {
            if ($m->file_url && Storage::disk('public')->exists($m->file_url)) {
                Storage::disk('public')->delete($m->file_url);
            }
            $m->delete();
        }
        $profil->delete();
        return redirect()->route('profil.index')->with('success', 'Profil berhasil dihapus.');
    }
}