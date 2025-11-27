@extends('layouts.admin.app')
@section('page-title', 'Edit Kategori Berita')

@section('content')

    {{-- Blok <style> dipindahkan ke css.blade.php --}}

    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header">
                <h4>Edit Kategori Berita</h4>
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

                <form action="{{ route('kategori-berita.update', ['kategori_beritum' => $item->kategori_id]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-panel">

                        {{-- ========== AWAL KODE DARI _form.blade.php ========== --}}
                        @php
                            $nama = old('nama', isset($item) ? $item->nama : '');
                            $slug = old('slug', isset($item) ? $item->slug : '');
                            $deskripsi = old('deskripsi', isset($item) ? $item->deskripsi : '');
                        @endphp

                        <{{-- HEADER SECTION --}} <div class="d-flex align-items-center mb-3">
                            <i class="material-icons text-primary me-2" style="font-size: 24px;">category</i>
                            <h6 class="mb-0 text-uppercase text-primary fw-bold">Detail Kategori</h6>
                    </div>

                    {{-- FORM CONTAINER --}}
                    <div class="card card-body border border-light shadow-none mb-4" style="background-color: #f8f9fa;">
                        <div class="row g-3">

                            {{-- Nama Kategori --}}
                            <div class="col-md-6">
                                <label for="nama" class="form-label fw-bold text-dark">Nama Kategori <span
                                        class="text-danger">*</span></label>
                                <input id="nama" name="nama" type="text"
                                    class="form-control bg-white border px-3" value="{{ $nama }}"
                                    placeholder="Contoh: Berita Desa, Pengumuman, Agenda" required>
                            </div>

                            {{-- Slug (URL) --}}
                            <div class="col-md-6">
                                <label for="slug" class="form-label fw-bold text-dark">Slug / URL <span
                                        class="fw-normal text-muted">(Opsional)</span></label>
                                <div class="input-group">
                                    {{-- Prefix visual agar user paham ini adalah link --}}
                                    <span class="input-group-text bg-white border-end-0 text-muted">/kategori/</span>
                                    <input id="slug" name="slug" type="text"
                                        class="form-control bg-white border border-start-0 px-2" value="{{ $slug }}"
                                        placeholder="berita-desa">
                                </div>
                                <small class="text-xs text-muted">Biarkan kosong untuk dibuat otomatis dari Nama
                                    Kategori.</small>
                            </div>

                            {{-- Deskripsi --}}
                            <div class="col-md-12">
                                <label for="deskripsi" class="form-label fw-bold text-dark">Deskripsi Singkat</label>
                                <textarea id="deskripsi" name="deskripsi" class="form-control bg-white border px-3" rows="4"
                                    placeholder="Tuliskan penjelasan singkat mengenai kategori ini...">{{ $deskripsi }}</textarea>
                            </div>

                        </div>
                    </div>
                    {{-- ========== AKHIR KODE DARI _form.blade.php ========== --}}

                    <div class="mt-3">
                        <button class="btn btn-primary btn-action mt-3">
                            <i class="material-icons opacity-10 me-1">save</i>
                            Update
                        </button>
                        <a href="{{ route('kategori-berita.index') }}" class="btn btn-secondary btn-action mt-3">
                            <i class="material-icons opacity-10 me-1">undo</i>
                            Batal
                        </a>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
@endsection
