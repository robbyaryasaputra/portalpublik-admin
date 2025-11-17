<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Models\Media;
use Illuminate\Http\Request; // V 1. Pastikan 'Request' di-import
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    // V 2. Ubah method index()
    public function index(Request $request)
    {
        // V 3. Tentukan kolom filter dan search
        $filterableColumns = ['provinsi']; // Kita akan filter berdasarkan provinsi
        $searchableColumns = ['nama_desa', 'kecamatan', 'kabupaten', 'email', 'telepon'];

        // V 4. Ambil data unik provinsi untuk dropdown filter
        // Kita ambil data provinsi yang unik dari tabel profils
        $provinsi = Profil::distinct()->orderBy('provinsi', 'asc')->pluck('provinsi');

        // V 5. Terapkan scope, paginate, dan withQueryString
        $profils = Profil::filter($request, $filterableColumns)
                        ->search($request, $searchableColumns)
                        ->orderBy('created_at', 'desc')
                        ->paginate(10)
                        ->withQueryString(); // <-- PENTING

        // V 6. Kirim data $profils dan $provinsi ke view
        return view('pages.profil.index', compact('profils', 'provinsi'));
    }

    // ... (method create, store, update, destroy biarkan apa adanya) ...
    // ...
    public function create()
    {
        return view('pages.profil.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_desa'     => 'required|string|max:255',
            'kecamatan'     => 'required|string|max:255',
            'kabupaten'     => 'required|string|max:255',
            'provinsi'      => 'required|string|max:255',
            'alamat_kantor' => 'nullable|string|max:255',
            'email'         => 'nullable|email|max:255|unique:profils,email',
            'telepon'       => 'nullable|string|max:50',
            'visi'          => 'nullable|string',
            'misi'          => 'nullable|string',
            'logo'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $profil = Profil::create($data);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('uploads/profils', 'public');
            Media::create([
                'ref_table' => 'profils',
                'ref_id' => $profil->profil_id,
                'file_url' => $path,
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
            'nama_desa'     => 'required|string|max:255',
            'kecamatan'     => 'required|string|max:255',
            'kabupaten'     => 'required|string|max:255',
            'provinsi'      => 'required|string|max:255',
            'alamat_kantor' => 'nullable|string|max:255',
            'email'         => 'nullable|email|max:255|unique:profils,email,' . $profil->profil_id . ',profil_id',
            'telepon'       => 'nullable|string|max:50',
            'visi'          => 'nullable|string',
            'misi'          => 'nullable|string',
            'logo'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $old = $profil->media()->orderBy('sort_order')->first();
            if ($old && Storage::disk('public')->exists($old->file_url)) {
                Storage::disk('public')->delete($old->file_url);
                $old->delete();
            }
            $path = $request->file('logo')->store('uploads/profils', 'public');
            Media::create([
                'ref_table' => 'profils',
                'ref_id' => $profil->profil_id,
                'file_url' => $path,
                'mime_type' => $request->file('logo')->getClientMimeType(),
            ]);
        }

        unset($data['logo']);
        $profil->update($data);
        return redirect()->route('profil.index')->with('success', 'Profil berhasil diupdate.');
    }

    public function destroy(Profil $profil)
    {
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
