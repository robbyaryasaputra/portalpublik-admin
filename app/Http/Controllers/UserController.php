<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request; // <-- Pastikan ini ada
use Illuminate\Support\Facades\Hash;

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
                     ->paginate(15)
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
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);

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
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui');
    }

    // Hapus user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus');
    }
}
