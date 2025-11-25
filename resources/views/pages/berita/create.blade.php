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
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-panel">
                            
                            @php
                                $judul = old('judul');
                                $slug = old('slug');
                                $kategori_id = old('kategori_id');
                                $penulis = old('penulis');
                                $status = old('status', 'draft');
                                $terbit_at = old('terbit_at');
                                $isi_html = old('isi_html');
                            @endphp

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group mb-3">
                                        <label for="judul">Judul Berita <span class="text-danger">*</span></label>
                                        <input id="judul" name="judul" type="text" class="form-control" value="{{ $judul }}" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="slug">Slug (URL) <small class="text-muted">(kosongkan untuk auto-generate)</small></label>
                                        <input id="slug" name="slug" type="text" class="form-control" value="{{ $slug }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="kategori_id">Kategori <span class="text-danger">*</span></label>
                                        <select id="kategori_id" name="kategori_id" class="form-control" required>
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach($kategori as $kat)
                                                <option value="{{ $kat->kategori_id }}" {{ $kategori_id == $kat->kategori_id ? 'selected' : '' }}>{{ $kat->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="status">Status</label>
                                        <select id="status" name="status" class="form-control">
                                            <option value="draft" {{ $status == 'draft' ? 'selected' : '' }}>Draft</option>
                                            <option value="published" {{ $status == 'published' ? 'selected' : '' }}>Published</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="penulis">Penulis</label>
                                        <input id="penulis" name="penulis" type="text" class="form-control" value="{{ $penulis }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="terbit_at">Tanggal Terbit (opsional)</label>
                                        <input id="terbit_at" name="terbit_at" type="datetime-local" class="form-control" value="{{ $terbit_at }}">
                                    </div>
                                </div>
                            </div>
                            
                            {{-- FOTO COVER (SINGLE) --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="fw-bold">Foto Sampul / Cover (Utama)</label>
                                        <input type="file" name="cover_image" class="form-control">
                                        <small class="text-muted">Hanya 1 foto untuk sampul berita.</small>
                                    </div>
                                </div>
                                
                                {{-- FOTO GALERI (MULTIPLE) - BARU --}}
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="fw-bold">Galeri Dokumentasi (Bisa Banyak)</label>
                                        <input type="file" name="gallery[]" class="form-control" multiple>
                                        <small class="text-muted">Tekan <b>Ctrl</b> untuk memilih banyak foto sekaligus.</small>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="isi_html">Isi Berita</label>
                                        <textarea id="isi_html" name="isi_html" class="form-control" rows="10">{{ $isi_html }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary btn-action">
                                    <i class="material-icons opacity-10 me-1">save</i> Simpan
                                </button>
                                <a href="{{ route('berita.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection