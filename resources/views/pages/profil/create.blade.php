@extends('layouts.admin.app')
@section('page-title', 'Tambah Profil Desa')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Tambah Profil Desa Baru</h6>
        </div>
        <div class="card-body px-4 py-4">
            
            @if($errors->any())
                <div class="alert alert-danger text-white">
                    <ul class="mb-0">@foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach</ul>
                </div>
            @endif

            <form action="{{ route('profil.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                {{-- SECTION 1: IDENTITAS --}}
                <h6 class="mb-3 text-sm text-uppercase text-secondary font-weight-bolder">Identitas Wilayah</h6>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nama Desa / Kelurahan</label>
                        <input type="text" name="nama_desa" class="form-control border px-2" value="{{ old('nama_desa') }}" required placeholder="Contoh: Desa Maju Jaya">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Logo Desa</label>
                        <input type="file" name="logo" class="form-control border px-2" accept="image/*">
                        <small class="text-muted text-xs">Format: JPG, PNG. Maks: 2MB.</small>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Kecamatan</label>
                        <input type="text" name="kecamatan" class="form-control border px-2" value="{{ old('kecamatan') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Kabupaten / Kota</label>
                        <input type="text" name="kabupaten" class="form-control border px-2" value="{{ old('kabupaten') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Provinsi</label>
                        <input type="text" name="provinsi" class="form-control border px-2" value="{{ old('provinsi') }}">
                    </div>
                </div>

                {{-- SECTION 2: KONTAK --}}
                <h6 class="mb-3 mt-4 text-sm text-uppercase text-secondary font-weight-bolder">Kontak & Alamat</h6>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Email Resmi</label>
                        <input type="email" name="email" class="form-control border px-2" value="{{ old('email') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">No. Telepon</label>
                        <input type="text" name="telepon" class="form-control border px-2" value="{{ old('telepon') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Alamat Kantor</label>
                        <textarea name="alamat_kantor" class="form-control border px-2" rows="2">{{ old('alamat_kantor') }}</textarea>
                    </div>
                </div>

                {{-- SECTION 3: VISI MISI --}}
                <h6 class="mb-3 mt-4 text-sm text-uppercase text-secondary font-weight-bolder">Visi & Misi</h6>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Visi</label>
                        <textarea name="visi" class="form-control border px-2" rows="3">{{ old('visi') }}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Misi</label>
                        <textarea name="misi" class="form-control border px-2" rows="5" placeholder="Tuliskan misi desa di sini...">{{ old('misi') }}</textarea>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end">
                    <a href="{{ route('profil.index') }}" class="btn btn-light me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Profil</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection