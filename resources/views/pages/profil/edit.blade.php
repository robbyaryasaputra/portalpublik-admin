@extends('layouts.admin.app')
@section('page-title', 'Edit Profil Desa')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">

            {{-- HEADER: Warna Pink (Primary) + Ikon Edit --}}
            <div class="card-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex align-items-center">
                <i class="material-icons opacity-10 text-white ps-3 me-2">edit</i>
                <h6 class="text-white text-capitalize mb-0">Edit Profil: {{ $profil->nama_desa }}</h6>
            </div>

            <div class="card-body px-4 py-4">

                <form action="{{ route('profil.update', $profil->profil_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- SECTION 1: IDENTITAS WILAYAH --}}
                    <div class="d-flex align-items-center mb-3">
                        <i class="material-icons text-primary me-2" style="font-size: 24px;">apartment</i>
                        <h6 class="mb-0 text-uppercase text-primary fw-bold">Identitas Wilayah</h6>
                    </div>

                    <div class="card card-body border border-light shadow-none mb-4" style="background-color: #f8f9fa;">
                        <div class="row g-3">
                            {{-- Nama Desa --}}
                            <div class="col-md-8">
                                <label class="form-label fw-bold text-dark">Nama Desa / Kelurahan <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="nama_desa" class="form-control bg-white border px-3"
                                    value="{{ old('nama_desa', $profil->nama_desa) }}" required>
                            </div>

                            {{-- Logo Desa (Dengan Preview) --}}
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-dark">Logo Desa</label>

                                {{-- Preview Logo Lama --}}
                                @if ($profil->logo)
                                    <div class="d-flex align-items-center mb-2 p-2 bg-white border rounded">
                                        <img src="{{ asset('storage/' . $profil->logo) }}" class="avatar avatar-sm me-2"
                                            style="object-fit:cover;">
                                        <div class="d-flex flex-column justify-content-center">
                                            <span class="text-xs fw-bold text-dark">Logo Saat Ini</span>
                                            <span class="text-xs text-success"><i
                                                    class="material-icons text-xs align-middle">check_circle</i>
                                                Tersimpan</span>
                                        </div>
                                    </div>
                                @endif

                                {{-- Input File --}}
                                <div class="input-group">
                                    <input type="file" name="logo" class="form-control bg-white border px-3"
                                        accept="image/*">
                                </div>
                                <small class="text-xs text-muted fst-italic">Biarkan kosong jika tidak ingin mengubah
                                    logo.</small>
                            </div>

                            {{-- Lokasi Administratif --}}
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-dark">Provinsi</label>
                                <input type="text" name="provinsi" class="form-control bg-white border px-3"
                                    value="{{ old('provinsi', $profil->provinsi) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-dark">Kabupaten / Kota</label>
                                <input type="text" name="kabupaten" class="form-control bg-white border px-3"
                                    value="{{ old('kabupaten', $profil->kabupaten) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-dark">Kecamatan</label>
                                <input type="text" name="kecamatan" class="form-control bg-white border px-3"
                                    value="{{ old('kecamatan', $profil->kecamatan) }}">
                            </div>
                        </div>
                    </div>

                    {{-- SECTION 2: KONTAK & ALamat --}}
                    <div class="d-flex align-items-center mb-3 mt-4">
                        <i class="material-icons text-primary me-2" style="font-size: 24px;">contact_phone</i>
                        <h6 class="mb-0 text-uppercase text-primary fw-bold">Kontak & Alamat</h6>
                    </div>

                    <div class="card card-body border border-light shadow-none mb-4" style="background-color: #f8f9fa;">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark">Email Resmi</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i
                                            class="material-icons text-sm">email</i></span>
                                    <input type="email" name="email"
                                        class="form-control bg-white border border-start-0 px-2"
                                        value="{{ old('email', $profil->email) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark">No. Telepon / WhatsApp</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i
                                            class="material-icons text-sm">call</i></span>
                                    <input type="text" name="telepon"
                                        class="form-control bg-white border border-start-0 px-2"
                                        value="{{ old('telepon', $profil->telepon) }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-bold text-dark">Alamat Kantor Lengkap</label>
                                <textarea name="alamat_kantor" class="form-control bg-white border px-3" rows="2">{{ old('alamat_kantor', $profil->alamat_kantor) }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- SECTION 3: VISI & MISI --}}
                    <div class="d-flex align-items-center mb-3 mt-4">
                        <i class="material-icons text-primary me-2" style="font-size: 24px;">flag</i>
                        <h6 class="mb-0 text-uppercase text-primary fw-bold">Visi & Misi</h6>
                    </div>

                    <div class="card card-body border border-light shadow-none mb-4" style="background-color: #f8f9fa;">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label fw-bold text-dark">Visi Desa</label>
                                <textarea name="visi" class="form-control bg-white border px-3" rows="3">{{ old('visi', $profil->visi) }}</textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-bold text-dark">Misi Desa</label>
                                <textarea name="misi" class="form-control bg-white border px-3" rows="5">{{ old('misi', $profil->misi) }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- TOMBOL AKSI DENGAN IKON & WARNA SESUAI BERITA --}}
                    <div class="mt-4 d-flex justify-content-end">
                        <a href="{{ route('profil.index') }}" class="btn btn-secondary me-2">
                            <i class="material-icons opacity-10 me-1">undo</i> Batal
                        </a>

                        <button type="submit" class="btn btn-primary">
                            <i class="material-icons opacity-10 me-1">save</i> Update
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
