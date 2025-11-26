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

                {{-- SECTION 1: IDENTITAS --}}
                <h6 class="mb-3 text-sm text-uppercase text-secondary font-weight-bolder">Identitas Wilayah</h6>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nama Desa / Kelurahan</label>
                        <input type="text" name="nama_desa" class="form-control border px-2" value="{{ old('nama_desa', $profil->nama_desa) }}" required>
                    </div>
                    
                    {{-- Preview Logo Lama --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Logo Desa</label>
                        <div class="d-flex align-items-center mb-2">
                            @if($profil->logo)
                                <img src="{{ asset('storage/' . $profil->logo) }}" class="avatar avatar-lg me-3 border shadow-sm" style="object-fit:cover; background:#fff;">
                                <span class="text-xs text-success fst-italic"><i class="material-icons text-xs">check</i> Logo tersimpan</span>
                            @else
                                <span class="text-xs text-secondary fst-italic">Belum ada logo.</span>
                            @endif
                        </div>
                        <input type="file" name="logo" class="form-control border px-2" accept="image/*">
                        <small class="text-muted text-xs">Upload baru untuk mengganti.</small>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Kecamatan</label>
                        <input type="text" name="kecamatan" class="form-control border px-2" value="{{ old('kecamatan', $profil->kecamatan) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Kabupaten</label>
                        <input type="text" name="kabupaten" class="form-control border px-2" value="{{ old('kabupaten', $profil->kabupaten) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Provinsi</label>
                        <input type="text" name="provinsi" class="form-control border px-2" value="{{ old('provinsi', $profil->provinsi) }}">
                    </div>
                </div>

                {{-- SECTION 2: KONTAK --}}
                <h6 class="mb-3 mt-4 text-sm text-uppercase text-secondary font-weight-bolder">Kontak & Alamat</h6>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Email Resmi</label>
                        <input type="email" name="email" class="form-control border px-2" value="{{ old('email', $profil->email) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">No. Telepon</label>
                        <input type="text" name="telepon" class="form-control border px-2" value="{{ old('telepon', $profil->telepon) }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Alamat Kantor</label>
                        <textarea name="alamat_kantor" class="form-control border px-2" rows="2">{{ old('alamat_kantor', $profil->alamat_kantor) }}</textarea>
                    </div>
                </div>

                {{-- SECTION 3: VISI MISI --}}
                <h6 class="mb-3 mt-4 text-sm text-uppercase text-secondary font-weight-bolder">Visi & Misi</h6>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Visi</label>
                        <textarea name="visi" class="form-control border px-2" rows="3">{{ old('visi', $profil->visi) }}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Misi</label>
                        <textarea name="misi" class="form-control border px-2" rows="5">{{ old('misi', $profil->misi) }}</textarea>
                    </div>
                </div>

                {{-- TOMBOL AKSI DENGAN IKON & WARNA SESUAI BERITA --}}
                <div class="mt-4 d-flex justify-content-end">
                    <a href="{{ route('profil.index') }}" class="btn btn-secondary me-2">
                        <i class="material-icons opacity-10 me-1">undo</i> Batal
                    </a>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="material-icons opacity-10 me-1">save</i> Update Perubahan
                    </button>
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection