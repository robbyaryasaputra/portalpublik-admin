@extends('layouts.admin.app')
@section('page-title', 'Tambah Galeri')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header">
                <h4>Buat Album Galeri Baru</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger text-white">
                        <ul>
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- SECTION 1: INFORMASI ALBUM --}}
                    <div class="d-flex align-items-center mb-3">
                        <i class="material-icons text-primary me-2" style="font-size: 24px;">collections</i>
                        <h6 class="mb-0 text-uppercase text-primary fw-bold">Informasi Album</h6>
                    </div>

                    <div class="card card-body border border-light shadow-none mb-4" style="background-color: #f8f9fa;">
                        <div class="row g-3">
                            {{-- Judul Album --}}
                            <div class="col-md-12">
                                <label class="form-label fw-bold text-dark">Judul Album <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="judul" class="form-control bg-white border px-3"
                                    value="{{ old('judul') }}" required placeholder="Contoh: Kegiatan HUT RI ke-79">
                            </div>

                            {{-- Deskripsi --}}
                            <div class="col-md-12">
                                <label class="form-label fw-bold text-dark">Deskripsi Singkat</label>
                                <textarea name="deskripsi" class="form-control bg-white border px-3" rows="3"
                                    placeholder="Ceritakan sedikit tentang momen di album ini...">{{ old('deskripsi') }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- SECTION 2: UPLOAD FOTO --}}
                    <div class="d-flex align-items-center mb-3 mt-4">
                        <i class="material-icons text-primary me-2" style="font-size: 24px;">add_a_photo</i>
                        <h6 class="mb-0 text-uppercase text-primary fw-bold">Upload Foto</h6>
                    </div>

                    <div class="card card-body border border-light shadow-none mb-4" style="background-color: #f8f9fa;">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label fw-bold text-dark">Pilih Foto (Bisa Banyak)</label>

                                {{-- Area Visual Upload --}}
                                <div class="p-4 bg-white border rounded text-center mb-3">
                                    <i class="material-icons text-primary opacity-50 mb-2"
                                        style="font-size: 48px;">cloud_upload</i>
                                    <p class="text-sm fw-bold mb-1">Upload foto-foto album di sini</p>
                                    <p class="text-xs text-muted mb-3">Format: JPG, PNG, JPEG. Maksimal ukuran per file
                                        menyesuaikan server.</p>

                                    <div class="input-group justify-content-center">
                                        {{-- Input File --}}
                                        <input type="file" name="photos[]" class="form-control border px-3" multiple
                                            accept="image/*" style="max-width: 500px;">
                                    </div>
                                </div>

                                {{-- Tips UX --}}
                                <div class="alert alert-light border border-dashed d-flex align-items-center mb-0"
                                    role="alert">
                                    <i class="material-icons text-info me-2">lightbulb</i>
                                    <div class="text-xs text-dark">
                                        <strong>Tips:</strong> Untuk memilih banyak foto sekaligus, tekan dan tahan tombol
                                        <span class="badge bg-secondary text-xxs mx-1">CTRL</span> (Windows) atau
                                        <span class="badge bg-secondary text-xxs mx-1">CMD</span> (Mac) saat mengklik file.
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- TOMBOL SIMPAN & BATAL --}}
                    <div class="mt-4">
                        <button class="btn btn-primary btn-action mt-3">
                            <i class="material-icons opacity-10 me-1">save</i>
                            Simpan
                        </button>
                        <a href="{{ route('galeri.index') }}" class="btn btn-secondary btn-action mt-3">
                            <i class="material-icons opacity-10 me-1">undo</i>
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
