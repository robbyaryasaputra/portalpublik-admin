@extends('layouts.admin.app')

@section('page-title', 'Kelola User')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Daftar User</h6>
                        <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">
                            <i class="material-icons me-1 align-middle" style="font-size: 1.7rem;">add_circle</i> Tambah User
                        </a>
                    </div>

                    <!-- V INI ADALAH FORM YANG SUDAH DIPERBAIKI -->
                    <div class="card-body border-bottom py-3">
                        <form action="{{ route('user.index') }}" method="GET">
                            <!-- 1. HAPUS SEMUA 'align-items' DARI 'row' -->
                            <div class="row g-3">

                                <div class="card-body border-bottom py-3">
                                    <form action="{{ route('user.index') }}" method="GET">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div
                                                    class="input-group input-group-outline mb-0 {{ request('search') ? 'is-filled' : '' }}">
                                                    <label class="form-label">Cari Nama/Email...</label>
                                                    <input type="text" class="form-control" name="search"
                                                        value="{{ request('search') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="input-group input-group-outline mb-0 is-filled">
                                                    <select class="form-control" name="role">
                                                        <option value="">Role</option>
                                                        <option value="admin"
                                                            {{ request('role') == 'admin' ? 'selected' : '' }}>Admin
                                                        </option>
                                                        <option value="guest"
                                                            {{ request('role') == 'guest' ? 'selected' : '' }}>Guest
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-3 d-flex align-items-end">
                                                <button type="submit" class="btn btn-primary me-2">
                                                    <i class="material-icons opacity-10">search</i> Cari
                                                </button>
                                                @if (request('search') || request('role'))
                                                    <a href="{{ route('user.index') }}" class="btn btn-secondary">
                                                        <i class="material-icons text-sm me-1">restart_alt</i>Reset
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- ^ BATAS AKHIR FORM -->

                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif

                                    <div class="table-responsive">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        NO</th>
                                                    {{-- TAMBAHAN KOLOM FOTO --}}
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Foto</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Name</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Email</th>
                                                    {{-- TAMBAHAN: HEADER ROLE --}}
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Role</th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Aksi</th>
                                                </tr>
                                            </thead>
                                            {{-- Di bagian <tbody> --}}
                                            <tbody>
                                                @forelse($items as $index => $item)
                                                    <tr>
                                                        <td class="text-center">
                                                            {{ ($items->currentPage() - 1) * $items->perPage() + $index + 1 }}
                                                        </td>

                                                        {{-- TAMPILAN FOTO USER --}}
                                                        <td>
                                                            @if ($item->avatar)
                                                                <img src="{{ asset('storage/' . $item->avatar) }}"
                                                                    class="avatar avatar-sm rounded-circle me-2 border"
                                                                    style="object-fit: cover;" alt="user-avatar">
                                                            @else
                                                                <img src="{{ asset('assets-admin/img/logos/user.png') }}"
                                                                    class="avatar avatar-sm rounded-circle me-2 border shadow-sm"
                                                                    style="object-fit: cover; opacity: 0.8;"
                                                                    alt="default-avatar">
                                                            @endif
                                                        </td>

                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->email }}</td>
                                                        <td class="align-middle text-sm">
                                                            @if ($item->role == 'admin')
                                                                <span
                                                                    class="badge badge-sm bg-gradient-success">Admin</span>
                                                            @else
                                                                <span
                                                                    class="badge badge-sm bg-gradient-secondary">Guest</span>
                                                            @endif
                                                        </td>


                                                        {{-- 5. AKSI (STYLE BARU SESUAI PERMINTAAN) --}}
                                                        <td class="text-center align-middle">
                                                            <div class="d-flex justify-content-center gap-2">

                                                                {{-- Tombol Detail (Hitam / Dark) --}}
                                                                <a href="{{ route('user.show', $item->id) }}"
                                                                    class="btn btn-sm btn-outline-dark mb-0 px-3"
                                                                    title="Lihat Detail">
                                                                    <i class="material-icons text-sm me-1">visibility</i>
                                                                    Detail
                                                                </a>

                                                                {{-- Tombol Edit (Cyan / Info) --}}
                                                                <a href="{{ route('user.edit', $item->id) }}"
                                                                    class="btn btn-sm btn-outline-info mb-0 px-3"
                                                                    title="Edit Data">
                                                                    <i class="material-icons text-sm me-1">edit</i> Edit
                                                                </a>

                                                                {{-- Tombol Hapus (Merah / Danger) --}}
                                                                <form action="{{ route('user.destroy', $item->id) }}"
                                                                    method="POST" style="display:inline"
                                                                    onsubmit="return confirm('Yakin ingin menghapus data profil desa ini?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn btn-sm btn-outline-danger mb-0 px-3"
                                                                        title="Hapus Permanen">
                                                                        <i class="material-icons text-sm me-1">delete</i>
                                                                        Hapus
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center">Belum ada user.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="mt-3">
                                        {{ $items->links('pagination::bootstrap-5') }}
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        @endsection
