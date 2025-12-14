@extends('layouts.admin.app')
@section('page-title', 'Edit Galeri')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header">
                <h4>Edit Album Galeri</h4>
            </div>
            <div class="card-body">

                <form action="{{ route('galeri.update', $galeri) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    {{-- SECTION 1: INFORMASI ALBUM --}}
                    <div class="d-flex align-items-center mb-3">
                        <i class="material-icons text-primary me-2" style="font-size: 24px;">edit_note</i>
                        <h6 class="mb-0 text-uppercase text-primary fw-bold">Edit Informasi Album</h6>
                    </div>

                    <div class="card card-body border border-light shadow-none mb-4" style="background-color: #f8f9fa;">
                        <div class="row g-3">
                            {{-- Judul --}}
                            <div class="col-md-12">
                                <label class="form-label fw-bold text-dark">Judul Album <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="judul" class="form-control bg-white border px-3"
                                    value="{{ old('judul', $galeri->judul) }}" required>
                            </div>

                            {{-- Deskripsi --}}
                            <div class="col-md-12">
                                <label class="form-label fw-bold text-dark">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control bg-white border px-3" rows="3">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- SECTION 2: FOTO TERSIMPAN --}}
                    <div class="d-flex align-items-center justify-content-between mb-3 mt-4">
                        <div class="d-flex align-items-center">
                            <i class="material-icons text-primary me-2" style="font-size: 24px;">photo_library</i>
                            <h6 class="mb-0 text-uppercase text-primary fw-bold">Foto Tersimpan</h6>
                        </div>
                        <span class="badge bg-primary rounded-pill">{{ $galeri->photos->count() }} Foto</span>
                    </div>

                    <div class="card card-body border border-light shadow-none mb-4" style="background-color: #f8f9fa;">
                        @if ($galeri->photos->count() > 0)
                            <div class="row g-3">
                                @foreach ($galeri->photos as $photo)
                                    <div class="col-6 col-md-3 col-lg-2">
                                        <div class="position-relative group-hover-overlay">
                                            <a href="{{ asset('storage/' . $photo->file_url) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $photo->file_url) }}"
                                                    class="img-thumbnail w-100 shadow-sm rounded"
                                                    style="height: 120px; object-fit: cover;" alt="Foto Galeri">
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4 text-muted">
                                <i class="material-icons text-secondary" style="font-size: 36px;">image_not_supported</i>
                                <p class="mb-0 text-sm">Belum ada foto di album ini.</p>
                            </div>
                        @endif
                    </div>

                    {{-- SECTION 3: TAMBAH FOTO BARU --}}
                    <div class="d-flex align-items-center mb-3 mt-4">
                        <i class="material-icons text-primary me-2" style="font-size: 24px;">add_a_photo</i>
                        <h6 class="mb-0 text-uppercase text-primary fw-bold">Tambah Foto Baru</h6>
                    </div>

                    <div class="card card-body border border-light shadow-none mb-4" style="background-color: #f8f9fa;">
                        <div class="row">
                            <div class="col-12">
                                <div class="p-3 bg-white border rounded text-center mb-2">
                                    <i class="material-icons text-secondary mb-2" style="font-size: 32px;">cloud_upload</i>
                                    <p class="text-sm fw-bold mb-1">Upload foto tambahan di sini</p>

                                    <div class="input-group justify-content-center mt-2">
                                        <input type="file" name="photos[]" class="form-control border px-3" multiple
                                            accept="image/*" style="max-width: 500px;">
                                    </div>
                                </div>

                                <div class="d-flex align-items-start gap-2 mt-2">
                                    <i class="material-icons text-info text-sm mt-1">info</i>
                                    <small class="text-muted text-xs">
                                        Foto yang diupload di sini akan <strong>ditambahkan</strong> ke album, tidak
                                        menghapus foto lama.<br>
                                        Gunakan tombol <b>CTRL / CMD</b> saat memilih file untuk mengupload banyak
                                        sekaligus.
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- TOMBOL SIMPAN & BATAL --}}

                    <div class="mt-4">
                        <button class="btn btn-primary btn-action mt-3">
                            <i class="material-icons opacity-10 me-1">save</i>
                            Update
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
