@extends('layouts.admin.app')
@section('page-title', 'Edit Agenda')

@section('content')
<div class="container-fluid py-4">
  <div class="card">
    <div class="card-header"><h4>Edit Agenda</h4></div>
    <div class="card-body">
      @if($errors->any())
        <div class="alert alert-danger text-white">
            <ul class="mb-0">@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul>
        </div>
      @endif
      
      <form action="{{ route('agenda.update', $agenda) }}" method="POST" enctype="multipart/form-data">
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
                   value="{{ old('tanggal_mulai', $agenda->tanggal_mulai->format('Y-m-d\TH:i')) }}" required>
          </div>

          <div class="mb-3 col-md-6">
            <label class="form-label fw-bold">Tanggal Selesai</label>
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
            <input type="file" name="poster" class="form-control border px-2">
            
            @if($agenda->poster)
                <div class="mt-3">
                    <label>Poster Saat Ini:</label><br>
                    <img src="{{ asset('storage/' . $agenda->poster) }}" class="img-thumbnail" style="height: 150px">
                </div>
            @endif
          </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Update Agenda</button>
            <a href="{{ route('agenda.index') }}" class="btn btn-secondary">Batal</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection