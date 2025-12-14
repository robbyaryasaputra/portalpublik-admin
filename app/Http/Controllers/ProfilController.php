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
        // Ambil list provinsi untuk dropdown (jika ada data)
        $provinsi = Profil::distinct()->whereNotNull('provinsi')->pluck('provinsi');

        $profils = Profil::with('media')
                        ->search($request->search)
                        ->when($request->provinsi, function($q) use ($request){
                            return $q->where('provinsi', $request->provinsi);
                        })
                        ->orderBy('created_at', 'desc')
                        ->paginate(30)
                        ->withQueryString();

        return view('pages.profil.index', compact('profils', 'provinsi'));
    }

    public function create()
    {
        return view('pages.profil.create');
    }

    public function store(Request $request)
    {
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
            'logo'          => 'nullable|image|max:2048', // Max 2MB
        ]);

        // 1. Simpan Data Profil
        $profil = Profil::create(collect($data)->except(['logo'])->toArray());

        // 2. Upload Logo
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

        return redirect()->route('profil.index')->with('success', 'Profil Desa berhasil ditambahkan.');
    }

    public function show($id)
    {
        $profil = Profil::with('media')->findOrFail($id);
        return view('pages.profil.show', compact('profil'));
    }

    public function edit($id)
    {
        $profil = Profil::with('media')->findOrFail($id);
        return view('pages.profil.edit', compact('profil'));
    }

    public function update(Request $request, $id)
    {
        $profil = Profil::findOrFail($id);

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
            'logo'          => 'nullable|image|max:2048',
        ]);

        // 1. Update Teks
        $profil->update(collect($data)->except(['logo'])->toArray());

        // 2. Update Logo (Hapus lama jika ada upload baru)
        if ($request->hasFile('logo')) {
            $oldLogo = $profil->media()->where('caption', 'logo')->first();
            
            if ($oldLogo) {
                if (Storage::disk('public')->exists($oldLogo->file_url)) {
                    Storage::disk('public')->delete($oldLogo->file_url);
                }
                $oldLogo->delete();
            }

            $path = $request->file('logo')->store('uploads/profils', 'public');
            Media::create([
                'ref_table' => 'profils',
                'ref_id'    => $profil->profil_id,
                'file_url'  => $path,
                'caption'   => 'logo',
                'mime_type' => $request->file('logo')->getClientMimeType(),
            ]);
        }

        return redirect()->route('profil.index')->with('success', 'Data profil berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $profil = Profil::with('media')->findOrFail($id);
        
        // Hapus file fisik & record media
        foreach ($profil->media as $m) {
            if ($m->file_url && Storage::disk('public')->exists($m->file_url)) {
                Storage::disk('public')->delete($m->file_url);
            }
            $m->delete();
        }
        
        $profil->delete();
        return redirect()->route('profil.index')->with('success', 'Data profil berhasil dihapus.');
    }
}