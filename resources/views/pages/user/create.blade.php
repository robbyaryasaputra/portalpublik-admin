@extends('layouts.admin.app')

@section('page-title', 'Tambah User')

@section('content')

    {{-- Blok <style> dipindahkan ke css.blade.php --}}

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Tambah User</h6>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $err)
                                        <li>{{ $err }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('user.store') }}" method="POST" class="form-dark-pink">
                            {{-- ========== AWAL KODE DARI _form.blade.php ========== --}}
                            @csrf
                            @php
                                // Saat create, $item tidak ada, jadi 'isset($item)' akan false
                                $name = old('name', '');
                                $email = old('email', '');
                            @endphp

                            {{-- SECTION 1: IDENTITAS PENGGUNA --}}
                            <div class="d-flex align-items-center mb-3">
                                <i class="material-icons text-primary me-2" style="font-size: 24px;">account_circle</i>
                                <h6 class="mb-0 text-uppercase text-primary fw-bold">Identitas Pengguna</h6>
                            </div>

                            <div class="card card-body border border-light shadow-none mb-4"
                                style="background-color: #f8f9fa;">
                                <div class="row g-3">
                                    {{-- Nama --}}
                                    <div class="col-md-6">
                                        <label for="name" class="form-label fw-bold text-dark">Nama Lengkap <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0"><i
                                                    class="material-icons text-sm">person</i></span>
                                            {{-- PERBAIKAN: Ditambahkan class 'text-dark' dan style color --}}
                                            <input id="name" name="name" type="text"
                                                class="form-control bg-white border border-start-0 px-2 text-dark"
                                                style="color: #333 !important;" value="{{ old('name') }}"
                                                placeholder="Contoh: Admin Desa" required>
                                        </div>
                                    </div>

                                    {{-- Email --}}
                                    <div class="col-md-6">
                                        <label for="email" class="form-label fw-bold text-dark">Alamat Email <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0"><i
                                                    class="material-icons text-sm">email</i></span>
                                            {{-- PERBAIKAN: Ditambahkan class 'text-dark' dan style color --}}
                                            <input id="email" name="email" type="email"
                                                class="form-control bg-white border border-start-0 px-2 text-dark"
                                                style="color: #333 !important;" value="{{ old('email') }}"
                                                placeholder="admin@contoh.com" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- SECTION 2: KEAMANAN AKUN --}}
                            <div class="d-flex align-items-center mb-3 mt-4">
                                <i class="material-icons text-primary me-2" style="font-size: 24px;">lock</i>
                                <h6 class="mb-0 text-uppercase text-primary fw-bold">Keamanan Akun</h6>
                            </div>

                            <div class="card card-body border border-light shadow-none mb-4"
                                style="background-color: #f8f9fa;">
                                <div class="row g-3">
                                    {{-- Password --}}
                                    <div class="col-md-6">
                                        <label for="password" class="form-label fw-bold text-dark">Password <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0"><i
                                                    class="material-icons text-sm">vpn_key</i></span>
                                            {{-- PERBAIKAN: Ditambahkan class 'text-dark' dan style color --}}
                                            <input id="password" name="password" type="password"
                                                class="form-control bg-white border border-start-0 px-2 text-dark"
                                                style="color: #333 !important;" placeholder="Minimal 8 karakter" required>
                                        </div>
                                        <small class="text-xs text-muted">Gunakan kombinasi huruf dan angka agar lebih
                                            aman.</small>
                                    </div>

                                    {{-- Confirm Password --}}
                                    <div class="col-md-6">
                                        <label for="password_confirmation" class="form-label fw-bold text-dark">Konfirmasi
                                            Password <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0"><i
                                                    class="material-icons text-sm">check_circle</i></span>
                                            {{-- PERBAIKAN: Ditambahkan class 'text-dark' dan style color --}}
                                            <input id="password_confirmation" name="password_confirmation" type="password"
                                                class="form-control bg-white border border-start-0 px-2 text-dark"
                                                style="color: #333 !important;" placeholder="Ulangi password di atas"
                                                required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Menambahkan tombol Simpan --}}
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="material-icons opacity-10 me-1">save</i>
                                    Simpan
                                </button>
                                <a href="{{ route('user.index') }}" class="btn btn-secondary">
                                    <i class="material-icons opacity-10 me-1">undo</i>
                                    Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
