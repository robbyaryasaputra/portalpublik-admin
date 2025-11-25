@extends('layouts.admin.app')
@section('page-title', 'Tambah Galeri')

@section('content')
<div class="container-fluid py-4">
  <div class="card">
    <div class="card-header"><h4>Buat Album Galeri Baru</h4></div>
    <div class="card-body">
      @if($errors->any())
        <div class="alert alert-danger text-white"><ul>@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul></div>
      @endif
      
      <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="mb-3 col-12">
            <label class="form-label fw-bold">Judul Album</label>
            <input type="text" name="judul" class="form-control border px-2" value="{{ old('judul') }}" required>
          </div>

          <div class="mb-3 col-12">
            <label class="form-label fw-bold">Deskripsi Singkat</label>
            <textarea name="deskripsi" class="form-control border px-2" rows="3">{{ old('deskripsi') }}</textarea>
          </div>

          <div class="mb-3 col-12">
            <label class="form-label fw-bold">Upload Foto (Bisa Banyak)</label>
            <div class="input-group input-group-outline">
                <input type="file" name="photos[]" class="form-control" multiple accept="image/*">
            </div>
            <small class="text-muted">Tekan tombol <b>CTRL</b> (di keyboard) sambil klik file untuk memilih banyak foto sekaligus.</small>
          </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Simpan Album</button>
            <a href="{{ route('galeri.index') }}" class="btn btn-secondary">Batal</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection