@extends('layouts.admin.app')
@section('page-title', 'Tambah Berita')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Tulis Berita Baru</h6>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-panel">

                                {{-- SETUP VARIABLES --}}
                                @php
                                    $judul = old('judul');
                                    $slug = old('slug');
                                    $kategori_id = old('kategori_id');
                                    $penulis = old('penulis');
                                    $status = old('status', 'draft');
                                    $terbit_at = old('terbit_at');
                                    $isi_html = old('isi_html');
                                @endphp

                                {{-- SECTION 1: INFORMASI DASAR --}}
                                <div class="d-flex align-items-center mb-3">
                                    <i class="material-icons text-primary me-2" style="font-size: 24px;">article</i>
                                    <h6 class="mb-0 text-uppercase text-primary fw-bold">Informasi Berita</h6>
                                </div>

                                <div class="card card-body border border-light shadow-none mb-4"
                                    style="background-color: #f8f9fa;">
                                    <div class="row g-3">
                                        {{-- Judul --}}
                                        <div class="col-md-12">
                                            <label class="form-label fw-bold text-dark">Judul Berita <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="judul" class="form-control bg-white border px-3"
                                                value="{{ old('judul') }}" required
                                                placeholder="Contoh: Pembangunan Jembatan Desa Telah Selesai">
                                        </div>

                                        {{-- Slug --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold text-dark">Slug / URL</label>
                                            <div class="input-group">
                                                <span
                                                    class="input-group-text bg-white border-end-0 text-muted">/berita/</span>
                                                <input type="text" name="slug"
                                                    class="form-control bg-white border border-start-0 px-2"
                                                    value="{{ old('slug') }}" placeholder="pembangunan-jembatan-desa">
                                            </div>
                                            <small class="text-xs text-muted">Kosongkan untuk membuat otomatis dari
                                                judul.</small>
                                        </div>

                                        {{-- Penulis --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold text-dark">Penulis</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-end-0"><i
                                                        class="material-icons text-sm">person</i></span>
                                                <input type="text" name="penulis"
                                                    class="form-control bg-white border border-start-0 px-2"
                                                    value="{{ old('penulis', Auth::user()->name ?? 'Admin') }}"
                                                    placeholder="Nama Penulis">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- SECTION 2: PENGATURAN PUBLIKASI --}}
                                <div class="d-flex align-items-center mb-3 mt-4">
                                    <i class="material-icons text-primary me-2" style="font-size: 24px;">tune</i>
                                    <h6 class="mb-0 text-uppercase text-primary fw-bold">Pengaturan Publikasi</h6>
                                </div>

                                <div class="card card-body border border-light shadow-none mb-4"
                                    style="background-color: #f8f9fa;">
                                    <div class="row g-3">
                                        {{-- Kategori --}}
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold text-dark">Kategori <span
                                                    class="text-danger">*</span></label>
                                            <select name="kategori_id" class="form-select bg-white border px-3" required>
                                                <option value="">-- Pilih Kategori --</option>
                                                @foreach ($kategori as $kat)
                                                    <option value="{{ $kat->kategori_id }}"
                                                        {{ old('kategori_id') == $kat->kategori_id ? 'selected' : '' }}>
                                                        {{ $kat->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- Status --}}
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold text-dark">Status</label>
                                            <select name="status" class="form-select bg-white border px-3">
                                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>
                                                    Draft (Konsep)</option>
                                                <option value="published"
                                                    {{ old('status') == 'published' ? 'selected' : '' }}>Published (Terbit)
                                                </option>
                                            </select>
                                        </div>

                                        {{-- Tanggal Terbit --}}
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold text-dark">Jadwal Terbit <small
                                                    class="fw-normal text-muted">(Opsional)</small></label>
                                            <input type="datetime-local" name="terbit_at"
                                                class="form-control bg-white border px-3" value="{{ old('terbit_at') }}">
                                        </div>
                                    </div>
                                </div>

                                {{-- SECTION 3: MEDIA & GALERI --}}
                                <div class="d-flex align-items-center mb-3 mt-4">
                                    <i class="material-icons text-primary me-2" style="font-size: 24px;">image</i>
                                    <h6 class="mb-0 text-uppercase text-primary fw-bold">Media & Galeri</h6>
                                </div>

                                <div class="card card-body border border-light shadow-none mb-4"
                                    style="background-color: #f8f9fa;">
                                    <div class="row g-3">
                                        {{-- Cover Image --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold text-dark">Cover Berita (Utama)</label>
                                            <div class="input-group mb-1">
                                                <input type="file" name="cover_image"
                                                    class="form-control bg-white border px-3" accept="image/*">
                                            </div>
                                            <small class="text-xs text-muted fst-italic"><i
                                                    class="material-icons text-xs align-middle">info</i> Foto ini akan
                                                muncul di halaman depan website.</small>
                                        </div>

                                        {{-- Gallery --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold text-dark">Galeri Dokumentasi</label>
                                            <div class="input-group mb-1">
                                                <input type="file" name="gallery[]"
                                                    class="form-control bg-white border px-3" multiple accept="image/*">
                                            </div>
                                            <small class="text-xs text-muted fst-italic">Tekan <b>Ctrl</b> (Windows) atau
                                                <b>Cmd</b> (Mac) untuk memilih banyak foto sekaligus.</small>
                                        </div>
                                    </div>
                                </div>

                                {{-- SECTION 4: ISI BERITA --}}
                                <div class="d-flex align-items-center mb-3 mt-4">
                                    <i class="material-icons text-primary me-2" style="font-size: 24px;">wysiwyg</i>
                                    <h6 class="mb-0 text-uppercase text-primary fw-bold">Konten Berita</h6>
                                </div>

                                <div class="card card-body border border-light shadow-none mb-4"
                                    style="background-color: #f8f9fa;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <textarea name="isi_html" class="form-control bg-white border px-3" rows="15"
                                                placeholder="Tuliskan berita lengkap di sini...">{{ old('isi_html') }}</textarea>
                                            <small class="text-muted text-xs mt-2 d-block">* Anda bisa memperbesar area
                                                teks dengan menarik sudut kanan bawah.</small>
                                        </div>
                                    </div>
                                </div>


                                <div class="mt-3">
                                    <button class="btn btn-primary btn-action mt-3">
                                        <i class="material-icons opacity-10 me-1">save</i>
                                        Simpan
                                    </button>
                                    <a href="{{ route('berita.index') }}" class="btn btn-secondary btn-action mt-3">
                                        <i class="material-icons opacity-10 me-1">undo</i>
                                        Batal
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
