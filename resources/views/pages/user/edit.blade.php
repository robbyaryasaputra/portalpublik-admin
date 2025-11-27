@extends('layouts.admin.app')

@section('page-title', 'Edit User')

@section('content')

    {{-- Blok <style> dipindahkan ke css.blade.php --}}

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Edit User</h6>
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

                        <form action="{{ route('user.update', $item->id) }}" method="POST" class="form-dark-pink">
                            @csrf @method('PUT')

                            {{-- ========== AWAL KODE DARI _form.blade.php ========== --}}
                            @php
                                // Saat edit, $item pasti ada
                                $name = old('name', $item->name);
                                $email = old('email', $item->email);
                            @endphp

                            {{-- SECTION 1: PROFIL AKUN --}}
                            <div class="d-flex align-items-center mb-3">
                                <i class="material-icons text-primary me-2" style="font-size: 24px;">account_circle</i>
                                <h6 class="mb-0 text-uppercase text-primary fw-bold">Profil Akun</h6>
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

                                            {{-- FIX: Tambahkan text-dark dan style color --}}
                                            <input id="name" name="name" type="text"
                                                class="form-control bg-white border border-start-0 px-2 text-dark"
                                                style="color: #333 !important;" value="{{ $name }}"
                                                placeholder="Nama Pengguna" required>
                                        </div>
                                    </div>

                                    {{-- Email --}}
                                    <div class="col-md-6">
                                        <label for="email" class="form-label fw-bold text-dark">Alamat Email <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0"><i
                                                    class="material-icons text-sm">email</i></span>

                                            {{-- FIX: Tambahkan text-dark dan style color --}}
                                            <input id="email" name="email" type="email"
                                                class="form-control bg-white border border-start-0 px-2 text-dark"
                                                style="color: #333 !important;" value="{{ $email }}"
                                                placeholder="user@example.com" required>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            {{-- SECTION 2: KEAMANAN (PASSWORD) --}}
                            <div class="d-flex align-items-center mb-3 mt-4">
                                <i class="material-icons text-primary me-2" style="font-size: 24px;">lock</i>
                                <h6 class="mb-0 text-uppercase text-primary fw-bold">Keamanan & Password</h6>
                            </div>

                            <div class="card card-body border border-light shadow-none mb-4"
                                style="background-color: #f8f9fa;">

                                {{-- Alert Info --}}
                                <div class="alert alert-light border border-dashed d-flex align-items-center py-2 mb-3">
                                    <i class="material-icons text-info me-2 text-sm">info</i>
                                    <small class="text-dark">Kosongkan kolom di bawah ini jika tidak ingin mengubah
                                        password.</small>
                                </div>

                                <div class="row g-3">
                                    {{-- Password Baru --}}
                                    <div class="col-md-6">
                                        <label for="password" class="form-label fw-bold text-dark">Password Baru</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0"><i
                                                    class="material-icons text-sm">vpn_key</i></span>

                                            {{-- FIX: Tambahkan text-dark dan style color --}}
                                            <input id="password" name="password" type="password"
                                                class="form-control bg-white border border-start-0 px-2 text-dark"
                                                style="color: #333 !important;" placeholder="Masukkan password baru...">
                                        </div>
                                    </div>

                                    {{-- Konfirmasi Password --}}
                                    <div class="col-md-6">
                                        <label for="password_confirmation" class="form-label fw-bold text-dark">Konfirmasi
                                            Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0"><i
                                                    class="material-icons text-sm">check_circle</i></span>

                                            {{-- FIX: Tambahkan text-dark dan style color --}}
                                            <input id="password_confirmation" name="password_confirmation" type="password"
                                                class="form-control bg-white border border-start-0 px-2 text-dark"
                                                style="color: #333 !important;" placeholder="Ulangi password baru...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- ========== AKHIR KODE DARI _form.blade.php ========== --}}

                            {{-- Menambahkan tombol Update --}}
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="material-icons opacity-10 me-1">save</i>
                                    Update
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
