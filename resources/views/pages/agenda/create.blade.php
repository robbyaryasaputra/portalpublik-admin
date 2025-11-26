@extends('layouts.admin.app')
@section('page-title', 'Tambah Agenda')

@section('content')
<div class="container-fluid py-4">
  <div class="card">
    
    {{-- Header Pink (Primary) --}}
    <div class="card-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
        <h6 class="text-white text-capitalize ps-3 mb-0">
            <i class="material-icons opacity-10 me-2 text-sm">event_note</i> Tambah Agenda Baru
        </h6>
    </div>

    <div class="card-body px-4 py-4">
      @if($errors->any())
        <div class="alert alert-danger text-white">
            <ul class="mb-0">@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul>
        </div>
      @endif
      
      <form action="{{ route('agenda.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="mb-3 col-md-12">
            <label class="form-label fw-bold">Judul Agenda</label>
            <input type="text" name="judul" class="form-control border px-2" value="{{ old('judul') }}" required placeholder="Contoh: Rapat Koordinasi Desa">
          </div>

          <div class="mb-3 col-md-6">
            <label class="form-label fw-bold">Tanggal Mulai</label>
            <input type="datetime-local" name="tanggal_mulai" class="form-control border px-2" value="{{ old('tanggal_mulai') }}" required>
          </div>

          <div class="mb-3 col-md-6">
            <label class="form-label fw-bold">Tanggal Selesai (Opsional)</label>
            <input type="datetime-local" name="tanggal_selesai" class="form-control border px-2" value="{{ old('tanggal_selesai') }}">
          </div>

          <div class="mb-3 col-md-6">
            <label class="form-label fw-bold">Lokasi</label>
            <input type="text" name="lokasi" class="form-control border px-2" value="{{ old('lokasi') }}" placeholder="Contoh: Balai Desa">
          </div>

          <div class="mb-3 col-md-6">
            <label class="form-label fw-bold">Penyelenggara</label>
            <input type="text" name="penyelenggara" class="form-control border px-2" value="{{ old('penyelenggara') }}" placeholder="Contoh: Karang Taruna">
          </div>

          <div class="mb-3 col-12">
            <label class="form-label fw-bold">Deskripsi Lengkap</label>
            <textarea name="deskripsi" class="form-control border px-2" rows="5" placeholder="Tuliskan detail kegiatan...">{{ old('deskripsi') }}</textarea>
          </div>

          <div class="mb-3 col-12">
            <label class="form-label fw-bold">Poster / Banner Agenda</label>
            <input type="file" name="poster" class="form-control border px-2" accept="image/*">
            <small class="text-muted text-xs">Format: JPG, PNG. Maks: 2MB.</small>
          </div>
        </div>

        <div class="mt-4 d-flex justify-content-end">
            <a href="{{ route('agenda.index') }}" class="btn btn-secondary me-2">
                <i class="material-icons opacity-10 me-1">undo</i> Batal
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="material-icons opacity-10 me-1">save</i> Simpan Agenda
            </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection