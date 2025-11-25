@extends('layouts.admin.app')
@section('page-title', 'Edit Profil')

@section('content')
<div class="container-fluid py-4">
  <div class="card">
    <div class="card-header"><h4>Edit Profil</h4></div>
    <div class="card-body">
      @if($errors->any())<div class="alert alert-danger"><ul>@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul></div>@endif
      
      <form action="{{ route('profil.update', $profil) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row profil-form">
          <div class="mb-3 col-6">
            <label class="form-label">Nama Desa</label>
            <input type="text" name="nama_desa" class="form-control" value="{{ old('nama_desa', $profil->nama_desa) }}">
          </div>
          <div class="mb-3 col-6">
            <label class="form-label">Kecamatan</label>
            <input type="text" name="kecamatan" class="form-control" value="{{ old('kecamatan', $profil->kecamatan) }}">
          </div>
          <div class="mb-3 col-6">
            <label class="form-label">Kabupaten</label>
            <input type="text" name="kabupaten" class="form-control" value="{{ old('kabupaten', $profil->kabupaten) }}">
          </div>
          <div class="mb-3 col-6">
            <label class="form-label">Provinsi</label>
            <input type="text" name="provinsi" class="form-control" value="{{ old('provinsi', $profil->provinsi) }}">
          </div>
          <div class="mb-3 col-12">
            <label class="form-label">Alamat Kantor</label>
            <textarea name="alamat_kantor" class="form-control" rows="2">{{ old('alamat_kantor', $profil->alamat_kantor) }}</textarea>
          </div>
          <div class="mb-3 col-6">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $profil->email) }}">
          </div>
          <div class="mb-3 col-6">
            <label class="form-label">Telepon</label>
            <input type="text" name="telepon" class="form-control" value="{{ old('telepon', $profil->telepon) }}">
          </div>
          <div class="mb-3 col-12">
            <label class="form-label">Visi</label>
            <textarea name="visi" class="form-control" rows="3">{{ old('visi', $profil->visi) }}</textarea>
          </div>
          <div class="mb-3 col-12">
            <label class="form-label">Misi</label>
            <textarea name="misi" class="form-control" rows="5">{{ old('misi', $profil->misi) }}</textarea>
          </div>
          
          {{-- EDIT LOGO --}}
          <div class="mb-3 col-12">
            <label class="form-label fw-bold">Logo (Ganti jika perlu)</label>
            <input type="file" name="logo" class="form-control">
            @if($profil->logo)
              <div class="mt-2">
                <small>Logo saat ini:</small><br>
                <img src="{{ asset('storage/'. $profil->logo) }}" style="height:80px; border:1px solid #ccc; padding:3px; border-radius:5px;">
              </div>
            @endif
          </div>

          {{-- Fitur Galeri sudah dihapus --}}

        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('profil.index') }}" class="btn btn-secondary">Batal</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection