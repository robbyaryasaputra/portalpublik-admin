@extends('layouts.admin.app')
@section('page-title', 'Tambah Profil Desa')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Tambah Profil Desa Baru</h6>
            </div>
            <div class="card-body px-4 py-4">

                @if ($errors->any())
                    <div class="alert alert-danger text-white">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('profil.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf


                    {{-- SECTION 1: IDENTITAS WILAYAH --}}
                    <div class="d-flex align-items-center mb-3">
                        <i class="material-icons text-primary me-2" style="font-size: 24px;">apartment</i>
                        <h6 class="mb-0 text-uppercase text-primary fw-bold">Identitas Wilayah</h6>
                    </div>
                    <div class="card card-body border border-light shadow-none mb-4" style="background-color: #f8f9fa;">
                        <div class="row g-3">
                            {{-- Nama Desa & Logo diletakkan sebaris agar hemat tempat --}}
                            <div class="col-md-8">
                                <label class="form-label fw-bold text-dark">Nama Desa / Kelurahan <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="nama_desa" class="form-control bg-white border px-3"
                                    value="{{ old('nama_desa') }}" required placeholder="Contoh: Desa Suka Makmur">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-dark">Logo Desa</label>
                                <div class="input-group">
                                    <input type="file" name="logo" class="form-control bg-white border px-3"
                                        accept="image/*">
                                </div>
                                <small class="text-xs text-muted fst-italic"><i
                                        class="material-icons text-xs align-middle">info</i> JPG/PNG, Maks. 2MB</small>
                            </div>

                            {{-- Lokasi Administratif --}}
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-dark">Provinsi</label>
                                <input type="text" name="provinsi" class="form-control bg-white border px-3"
                                    value="{{ old('provinsi') }}" placeholder="Contoh: Jawa Barat">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-dark">Kabupaten / Kota</label>
                                <input type="text" name="kabupaten" class="form-control bg-white border px-3"
                                    value="{{ old('kabupaten') }}" placeholder="Contoh: Bandung">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-dark">Kecamatan</label>
                                <input type="text" name="kecamatan" class="form-control bg-white border px-3"
                                    value="{{ old('kecamatan') }}" placeholder="Contoh: Cileunyi">
                            </div>
                        </div>
                    </div>

                    {{-- SECTION 2: KONTAK & ALAMAT --}}
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
                                        class="form-control bg-white border border-start-0 px-2" value="{{ old('email') }}"
                                        placeholder="desa@mail.com">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark">No. Telepon / WhatsApp</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i
                                            class="material-icons text-sm">call</i></span>
                                    <input type="text" name="telepon"
                                        class="form-control bg-white border border-start-0 px-2"
                                        value="{{ old('telepon') }}" placeholder="0812...">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-bold text-dark">Alamat Kantor Lengkap</label>
                                <textarea name="alamat_kantor" class="form-control bg-white border px-3" rows="2"
                                    placeholder="Jalan, RT/RW, Kode Pos">{{ old('alamat_kantor') }}</textarea>
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
                                <textarea name="visi" class="form-control bg-white border px-3" rows="3"
                                    placeholder="Tuliskan visi desa secara singkat dan jelas...">{{ old('visi') }}</textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-bold text-dark">Misi Desa</label>
                                <textarea name="misi" class="form-control bg-white border px-3" rows="5"
                                    placeholder="1. Misi pertama&#10;2. Misi kedua&#10;3. Misi ketiga">{{ old('misi') }}</textarea>
                                <small class="text-muted text-xs ms-1">* Gunakan baris baru (Enter) untuk setiap poin
                                    misi.</small>
                            </div>
                        </div>
                    </div>


                    <div class="mt-4 d-flex justify-content-end">
                        <a href="{{ route('profil.index') }}" class="btn btn-secondary me-2">
                            <i class="material-icons opacity-10 me-1">undo</i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="material-icons opacity-10 me-1">save</i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
