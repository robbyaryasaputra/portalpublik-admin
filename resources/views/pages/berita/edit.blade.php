@extends('layouts.admin.app')
@section('page-title', 'Edit Berita')

@section('content')
<div class="container-fluid py-4">
  <div class="card">
    <div class="card-header"><h4>Edit Berita</h4></div>
    <div class="card-body">
      @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul>
        </div>
      @endif

        <form action="{{ route('berita.update', ['beritum' => $item->berita_id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-panel">

            @php
                $judul = old('judul', $item->judul);
                $slug = old('slug', $item->slug);
                $kategori_id = old('kategori_id', $item->kategori_id);
                $penulis = old('penulis', $item->penulis);
                $status = old('status', $item->status);
                $terbit_at = old('terbit_at', $item->terbit_at ? \Carbon\Carbon::parse($item->terbit_at)->format('Y-m-d\TH:i') : '');
                $isi_html = old('isi_html', $item->isi_html);
            @endphp

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group mb-3">
                        <label for="judul">Judul Berita <span class="text-danger">*</span></label>
                        <input id="judul" name="judul" type="text" class="form-control" value="{{ $judul }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="slug">Slug (URL)</label>
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

            <div class="row">
                {{-- EDIT COVER --}}
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label class="fw-bold">Foto Sampul / Cover</label>
                        <input type="file" name="cover_image" class="form-control">
                        @if($item->cover)
                            <div class="mt-2">
                                <small>Cover Saat Ini:</small><br>
                                <img src="{{ asset('storage/' . $item->cover) }}" class="img-thumbnail" style="height: 100px;">
                            </div>
                        @endif
                    </div>
                </div>

                {{-- EDIT GALERI --}}
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label class="fw-bold">Tambah Galeri Dokumentasi</label>
                        <input type="file" name="gallery[]" class="form-control" multiple>
                        <small class="text-muted">Upload foto baru untuk menambahkan ke galeri.</small>
                    </div>
                </div>
            </div>

            {{-- PREVIEW GALERI --}}
            @if($item->gallery->count() > 0)
                <div class="mb-3 p-3 bg-light border rounded">
                    <label class="fw-bold mb-2">Dokumentasi Tersimpan:</label>
                    <div class="row g-2">
                        @foreach($item->gallery as $img)
                            <div class="col-4 col-md-2">
                                <a href="{{ asset('storage/' . $img->file_url) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $img->file_url) }}" class="img-thumbnail w-100" style="height: 80px; object-fit: cover;">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="isi_html">Isi Berita</label>
                        <textarea id="isi_html" name="isi_html" class="form-control" rows="10">{{ $isi_html }}</textarea>
                    </div>
                </div>
            </div>

            <div class="mt-3">
                    <button class="btn btn-primary btn-action">
                        <i class="material-icons opacity-10 me-1">save</i> Update
                    </button>
                    <a href="{{ route('berita.index') }}" class="btn btn-secondary">Batal</a>
            </div>
            </div>
        </form>
    </div>
  </div>
</div>
@endsection