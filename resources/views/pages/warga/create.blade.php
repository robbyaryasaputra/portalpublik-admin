@extends('layouts.admin.app')
@section('page-title', 'Tambah Warga')

@section('content')
    {{-- Blok <style> dipindahkan ke css.blade.php --}}

    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Warga</h4>
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

                <form action="{{ route('warga.store') }}" method="POST" class="warga-form">
                    @csrf

                    {{-- SECTION 1: IDENTITAS PRIBADI --}}
                    <div class="d-flex align-items-center mb-3">
                        <i class="material-icons text-primary me-2" style="font-size: 24px;">badge</i>
                        <h6 class="mb-0 text-uppercase text-primary fw-bold">Identitas Pribadi</h6>
                    </div>

                    <div class="card card-body border border-light shadow-none mb-4" style="background-color: #f8f9fa;">
                        <div class="row g-3">

                            {{-- Nama Lengkap --}}
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark">Nama Lengkap <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i
                                            class="material-icons text-sm">person</i></span>
                                    {{-- FIX: Warna Teks --}}
                                    <input type="text" name="nama"
                                        class="form-control bg-white border border-start-0 px-2 text-dark"
                                        style="color: #333 !important;" value="{{ old('nama') }}"
                                        placeholder="Tulis nama lengkap sesuai KTP..." required>
                                </div>
                            </div>

                            {{-- Jenis Kelamin --}}
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark">Jenis Kelamin <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i
                                            class="material-icons text-sm">wc</i></span>
                                    {{-- FIX: Warna Teks pada Select --}}
                                    <select name="jenis_kelamin"
                                        class="form-select bg-white border border-start-0 px-2 text-dark"
                                        style="color: #333 !important;" required>
                                        <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                                        <option value="Laki-laki"
                                            {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan"
                                            {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            {{-- NIK --}}
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark">NIK (Nomor Induk Kependudukan) <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i
                                            class="material-icons text-sm">fingerprint</i></span>
                                    {{-- FIX: Warna Teks --}}
                                    <input type="text" name="no_ktp"
                                        class="form-control bg-white border border-start-0 px-2 text-dark"
                                        style="color: #333 !important;" value="{{ old('no_ktp') }}"
                                        placeholder="16 digit NIK..." required maxlength="16">
                                </div>
                            </div>

                            {{-- No. KK --}}
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark">No. Kartu Keluarga (KK)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i
                                            class="material-icons text-sm">family_restroom</i></span>
                                    {{-- FIX: Warna Teks --}}
                                    <input type="text" name="no_kk"
                                        class="form-control bg-white border border-start-0 px-2 text-dark"
                                        style="color: #333 !important;" value="{{ old('no_kk') }}"
                                        placeholder="16 digit Nomor KK..." maxlength="16">
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- SECTION 2: INFORMASI SOSIAL --}}
                    <div class="d-flex align-items-center mb-3 mt-4">
                        <i class="material-icons text-primary me-2" style="font-size: 24px;">work</i>
                        <h6 class="mb-0 text-uppercase text-primary fw-bold">Pekerjaan & Agama</h6>
                    </div>

                    <div class="card card-body border border-light shadow-none mb-4" style="background-color: #f8f9fa;">
                        <div class="row g-3">

                            {{-- Agama --}}
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark">Agama</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i
                                            class="material-icons text-sm">menu_book</i></span>
                                    {{-- FIX: Warna Teks --}}
                                    <input type="text" name="agama"
                                        class="form-control bg-white border border-start-0 px-2 text-dark"
                                        style="color: #333 !important;" value="{{ old('agama') }}"
                                        placeholder="Contoh: Islam, Kristen, dll">
                                </div>
                            </div>

                            {{-- Pekerjaan --}}
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark">Pekerjaan</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i
                                            class="material-icons text-sm">work_outline</i></span>
                                    {{-- FIX: Warna Teks --}}
                                    <input type="text" name="pekerjaan"
                                        class="form-control bg-white border border-start-0 px-2 text-dark"
                                        style="color: #333 !important;" value="{{ old('pekerjaan') }}"
                                        placeholder="Contoh: Wiraswasta, PNS, Petani">
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- SECTION 3: KONTAK --}}
                    <div class="d-flex align-items-center mb-3 mt-4">
                        <i class="material-icons text-primary me-2" style="font-size: 24px;">contact_phone</i>
                        <h6 class="mb-0 text-uppercase text-primary fw-bold">Kontak</h6>
                    </div>

                    <div class="card card-body border border-light shadow-none mb-4" style="background-color: #f8f9fa;">
                        <div class="row g-3">

                            {{-- Telepon --}}
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark">No. Telepon / WhatsApp</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i
                                            class="material-icons text-sm">call</i></span>
                                    {{-- FIX: Warna Teks --}}
                                    <input type="text" name="telp"
                                        class="form-control bg-white border border-start-0 px-2 text-dark"
                                        style="color: #333 !important;" value="{{ old('telp') }}"
                                        placeholder="Contoh: 081234567890">
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark">Alamat Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i
                                            class="material-icons text-sm">email</i></span>
                                    {{-- FIX: Warna Teks --}}
                                    <input type="email" name="email"
                                        class="form-control bg-white border border-start-0 px-2 text-dark"
                                        style="color: #333 !important;" value="{{ old('email') }}"
                                        placeholder="nama@email.com">
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- TOMBOL SIMPAN & BATAL --}}

                    <button type="submit" class="btn btn-primary btn-action mt-3">
                        <i class="material-icons opacity-10 me-1">save</i>
                        Simpan
                    </button>
                    <a href="{{ route('warga.index') }}" class="btn btn-secondary btn-action mt-3">
                        <i class="material-icons opacity-10 me-1">undo</i>
                        Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
