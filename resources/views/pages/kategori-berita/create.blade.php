@extends('layouts.admin.app')

@section('page-title', 'Tambah Kategori Berita')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Tambah Kategori Baru</h6>
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

                        {{-- Blok <style> dipindahkan ke css.blade.php --}}

                        <form action="{{ route('kategori-berita.store') }}" method="POST">
                            <div class="form-panel">
                                {{-- ========== AWAL KODE DARI _form.blade.php ========== --}}
                                @csrf

                                @php
                                    $nama = old('nama', isset($item) ? $item->nama : '');
                                    $slug = old('slug', isset($item) ? $item->slug : '');
                                    $deskripsi = old('deskripsi', isset($item) ? $item->deskripsi : '');
                                @endphp

                                {{-- HEADER SECTION --}}
                                <div class="d-flex align-items-center mb-3">
                                    <i class="material-icons text-primary me-2" style="font-size: 24px;">category</i>
                                    <h6 class="mb-0 text-uppercase text-primary fw-bold">Informasi Kategori</h6>
                                </div>

                                {{-- FORM CONTAINER --}}
                                <div class="card card-body border border-light shadow-none mb-4"
                                    style="background-color: #f8f9fa;">
                                    <div class="row g-3">

                                        {{-- Nama Kategori --}}
                                        <div class="col-md-6">
                                            <label for="nama" class="form-label fw-bold text-dark">Nama Kategori <span
                                                    class="text-danger">*</span></label>
                                            <input id="nama" name="nama" type="text"
                                                class="form-control bg-white border px-3" value="{{ $nama }}"
                                                placeholder="Contoh: Berita Desa, Pengumuman, Layanan" required>
                                        </div>

                                        {{-- Slug (URL) --}}
                                        <div class="col-md-6">
                                            <label for="slug" class="form-label fw-bold text-dark">Slug / URL <span
                                                    class="fw-normal text-muted">(Opsional)</span></label>
                                            <div class="input-group">
                                                {{-- Prefix visual agar user paham ini adalah link --}}
                                                <span
                                                    class="input-group-text bg-white border-end-0 text-muted">/kategori/</span>
                                                <input id="slug" name="slug" type="text"
                                                    class="form-control bg-white border border-start-0 px-2"
                                                    value="{{ $slug }}" placeholder="berita-desa">
                                            </div>
                                            <small class="text-xs text-muted">Biarkan kosong untuk dibuat otomatis dari Nama
                                                Kategori.</small>
                                        </div>

                                        {{-- Deskripsi --}}
                                        <div class="col-md-12">
                                            <label for="deskripsi" class="form-label fw-bold text-dark">Deskripsi
                                                Singkat</label>
                                            <textarea id="deskripsi" name="deskripsi" class="form-control bg-white border px-3" rows="4"
                                                placeholder="Tuliskan penjelasan singkat mengenai kategori ini...">{{ $deskripsi }}</textarea>
                                        </div>

                                    </div>
                                </div>
                                {{-- ========== AKHIR KODE DARI _form.blade.php ========== --}}

                                {{-- ========== AWAL KODE DARI _form.blade.php ========== --}}

                                <div class="mt-3">
                                    <button class="btn btn-primary btn-action mt-3">
                                        <i class="material-icons opacity-10 me-1">save</i>
                                        Simpan
                                    </button>
                                    <a href="{{ route('kategori-berita.index') }}"
                                        class="btn btn-secondary btn-action mt-3">
                                        <i class="material-icons opacity-10 me-1">undo</i>
                                        Batal
                                    </a>
                                </div>
                            </div>
                            {{-- ========== AKHIR KODE DARI _form.blade.php ========== --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
