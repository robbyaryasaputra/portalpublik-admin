@extends('layouts.admin.app')
@section('page-title', 'Edit Agenda')

@section('content')
<div class="container-fluid py-4">
  <div class="card">
    
    {{-- Header Pink (Primary) --}}
    <div class="card-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex align-items-center">
        <i class="material-icons opacity-10 text-white ps-3 me-2">edit</i>
        <h6 class="text-white text-capitalize mb-0">Edit Agenda: {{ $agenda->judul }}</h6>
    </div>

    <div class="card-body px-4 py-4">
      @if($errors->any())
        <div class="alert alert-danger text-white">
            <ul class="mb-0">@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul>
        </div>
      @endif
      
      <form action="{{ route('agenda.update', $agenda->agenda_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
          <div class="mb-3 col-md-12">
            <label class="form-label fw-bold">Judul Agenda</label>
            <input type="text" name="judul" class="form-control border px-2" value="{{ old('judul', $agenda->judul) }}" required>
          </div>

          <div class="mb-3 col-md-6">
            <label class="form-label fw-bold">Tanggal Mulai</label>
            <input type="datetime-local" name="tanggal_mulai" class="form-control border px-2" 
                   value="{{ old('tanggal_mulai', $agenda->tanggal_mulai ? $agenda->tanggal_mulai->format('Y-m-d\TH:i') : '') }}" required>
          </div>

          <div class="mb-3 col-md-6">
            <label class="form-label fw-bold">Tanggal Selesai (Opsional)</label>
            <input type="datetime-local" name="tanggal_selesai" class="form-control border px-2" 
                   value="{{ old('tanggal_selesai', $agenda->tanggal_selesai ? $agenda->tanggal_selesai->format('Y-m-d\TH:i') : '') }}">
          </div>

          <div class="mb-3 col-md-6">
            <label class="form-label fw-bold">Lokasi</label>
            <input type="text" name="lokasi" class="form-control border px-2" value="{{ old('lokasi', $agenda->lokasi) }}">
          </div>

          <div class="mb-3 col-md-6">
            <label class="form-label fw-bold">Penyelenggara</label>
            <input type="text" name="penyelenggara" class="form-control border px-2" value="{{ old('penyelenggara', $agenda->penyelenggara) }}">
          </div>

          <div class="mb-3 col-12">
            <label class="form-label fw-bold">Deskripsi Lengkap</label>
            <textarea name="deskripsi" class="form-control border px-2" rows="5">{{ old('deskripsi', $agenda->deskripsi) }}</textarea>
          </div>

          <div class="mb-3 col-12">
            <label class="form-label fw-bold">Ganti Poster (Opsional)</label>
            
            <div class="d-flex align-items-center mb-2">
                @if($agenda->poster)
                    <img src="{{ asset('storage/' . $agenda->poster) }}" class="avatar avatar-lg me-3 border shadow-sm" style="object-fit:cover;">
                    <span class="text-xs text-success fst-italic"><i class="material-icons text-xs">check</i> Poster tersimpan</span>
                @else
                    <span class="text-xs text-secondary fst-italic">Belum ada poster.</span>
                @endif
            </div>

            <input type="file" name="poster" class="form-control border px-2" accept="image/*">
            <small class="text-muted text-xs">Upload baru untuk mengganti.</small>
          </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="mt-4 d-flex justify-content-end">
            <a href="{{ route('agenda.index') }}" class="btn btn-secondary me-2">
                <i class="material-icons opacity-10 me-1">undo</i> Batal
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="material-icons opacity-10 me-1">save</i> Update Perubahan
            </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection