@extends('layouts.admin.app')
@section('page-title', 'Edit Galeri')

@section('content')
<div class="container-fluid py-4">
  <div class="card">
    <div class="card-header"><h4>Edit Album Galeri</h4></div>
    <div class="card-body">
      
      <form action="{{ route('galeri.update', $galeri) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-bold">Judul Album</label>
            <input type="text" name="judul" class="form-control border px-2" value="{{ old('judul', $galeri->judul) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Deskripsi</label>
            <textarea name="deskripsi" class="form-control border px-2" rows="3">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
        </div>

        {{-- Menampilkan Foto yang sudah ada --}}
        <div class="mb-3">
            <label class="fw-bold mb-2">Foto Tersimpan:</label>
            <div class="row g-2">
                @foreach($galeri->photos as $photo)
                <div class="col-6 col-md-2">
                    <a href="{{ asset('storage/'.$photo->file_url) }}" target="_blank">
                        <img src="{{ asset('storage/'.$photo->file_url) }}" class="img-thumbnail w-100" style="height: 100px; object-fit: cover;">
                    </a>
                </div>
                @endforeach
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Tambah Foto Baru</label>
            <input type="file" name="photos[]" class="form-control border px-2" multiple>
            <small class="text-muted">Upload foto baru untuk menambahkan ke album ini.</small>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Update Album</button>
            <a href="{{ route('galeri.index') }}" class="btn btn-secondary">Batal</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection