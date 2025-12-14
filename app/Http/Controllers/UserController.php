<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Menampilkan daftar user
     */
    // V 1. Ubah method index()
    public function index(Request $request) // Tambahkan Request $request
    {
        // Tentukan kolom
        $filterableColumns = []; // Tidak ada filter dropdown untuk User saat ini
        $searchableColumns = ['name', 'email']; // Kolom yang ingin dicari

        // Terapkan scope, paginate, dan withQueryString
        $items = User::filter($request, $filterableColumns)
                     ->search($request, $searchableColumns)
                     ->orderBy('id', 'desc')
                     ->paginate(30)
                     ->withQueryString(); // <-- PENTING

        return view('pages.user.index', compact('items'));
    }

    

    // Tampilkan form pembuatan user
    public function create()
    {
        return view('pages.user.create');
    }

    // Simpan user baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'avatar'   => 'nullable|image|max:2048', // <--- Validasi Foto
            'role' => 'required|string|in:admin,guest',
        ]);

        $data['password'] = Hash::make($data['password']);
        
        // 1. Buat User
        $user = User::create($data);

        // 2. Upload Foto Profil (Jika ada)
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('uploads/users', 'public');
            
            Media::create([
                'ref_table' => 'users',
                'ref_id'    => $user->id,
                'file_url'  => $path,
                'caption'   => 'avatar',
                'mime_type' => $request->file('avatar')->getClientMimeType(),
            ]);
        }

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan');
    }

    // Tampilkan detail user
    public function show(User $user)
    {
        return view('pages.user.show', ['item' => $user]);
    }

    // Tampilkan form edit
    public function edit(User $user)
    {
        return view('pages.user.edit', ['item' => $user]);
    }

    // Perbarui data user
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'avatar'   => 'nullable|image|max:2048', // <--- Validasi Foto
            'role' => 'required|string|in:admin,guest',
        ]);

        // Update Password jika diisi
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        // Logic Update Foto
        if ($request->hasFile('avatar')) {
            // 1. Cari foto lama
            $oldAvatar = $user->media()->where('caption', 'avatar')->first();
            
            // 2. Hapus foto lama
            if ($oldAvatar) {
                if (Storage::disk('public')->exists($oldAvatar->file_url)) {
                    Storage::disk('public')->delete($oldAvatar->file_url);
                }
                $oldAvatar->delete();
            }

            // 3. Upload baru
            $path = $request->file('avatar')->store('uploads/users', 'public');
            Media::create([
                'ref_table' => 'users',
                'ref_id'    => $user->id,
                'file_url'  => $path,
                'caption'   => 'avatar',
                'mime_type' => $request->file('avatar')->getClientMimeType(),
            ]);
        }

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui');
    }

    // Hapus user
    public function destroy(User $user)
    {
        
        $user->load('media');
        foreach ($user->media as $media) {
            if (Storage::disk('public')->exists($media->file_url)) {
                Storage::disk('public')->delete($media->file_url);
            }
            $media->delete();
        }

        $user->delete();
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus');
    }
}
