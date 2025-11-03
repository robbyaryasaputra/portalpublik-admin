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

        {{-- ========== AWAL KODE DARI _form.blade.php ========== --}}
        {{-- Blok <style> dipindahkan ke css.blade.php --}}

        <div class="row profil-form">
          <div class="mb-3 col-6">
            <label class="form-label">Nama Desa</label>
            <input type="text" name="nama_desa" class="form-control" value="{{ old('nama_desa', isset($profil) ? $profil->nama_desa : '') }}" placeholder="Contoh: Desa Suka Maju">
          </div>
          <div class="mb-3 col-6">
            <label class="form-label">Kecamatan</label>
            <input type="text" name="kecamatan" class="form-control" value="{{ old('kecamatan', isset($profil) ? $profil->kecamatan : '') }}" placeholder="Contoh: Kecamatan Sejahtera">
          </div>
          <div class="mb-3 col-6">
            <label class="form-label">Kabupaten</label>
            <input type="text" name="kabupaten" class="form-control" value="{{ old('kabupaten', isset($profil) ? $profil->kabupaten : '') }}" placeholder="Contoh: Kabupaten Merdeka">
          </div>
          <div class="mb-3 col-6">
            <label class="form-label">Provinsi</label>
            <input type="text" name="provinsi" class="form-control" value="{{ old('provinsi', isset($profil) ? $profil->provinsi : '') }}" placeholder="Contoh: Provinsi Jaya">
          </div>
          <div class="mb-3 col-6">
            <label class="form-label">Alamat Kantor</label>
            <input type="text" name="alamat_kantor" class="form-control" value="{{ old('alamat_kantor', isset($profil) ? $profil->alamat_kantor : '') }}" placeholder="Jl. Raya Desa No. 1, Suka Maju">
          </div>
          <div class="mb-3 col-6">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', isset($profil) ? $profil->email : '') }}" placeholder="info@sukamaju.desa.id">
          </div>
          <div class="mb-3 col-6">
            <label class="form-label">Telepon</label>
            <input type="text" name="telepon" class="form-control" value="{{ old('telepon', isset($profil) ? $profil->telepon : '') }}" placeholder="0812-3456-7890">
          </div>
          <div class="mb-3 col-12">
            <label class="form-label">Visi</label>
            <textarea name="visi" class="form-control" rows="3" placeholder="Tuliskan visi desa di sini...">{{ old('visi', isset($profil) ? $profil->visi : '') }}</textarea>
          </div>
          <div class="mb-3 col-12">
            <label class="form-label">Misi</label>
            <textarea name="misi" class="form-control" rows="5" placeholder="1. Misi pertama...\n2. Misi kedua...\n3. Dst...">{{ old('misi', isset($profil) ? $profil->misi : '') }}</textarea>
          </div>
          <div class="mb-3 col-12">
            <label class="form-label">Logo (gambar)</label>
            <input type="file" name="logo" class="form-control">
            @if(isset($profil) && $profil->logo)
              <div class="mt-2">
                <small>Preview saat ini:</small>
                <div style="margin-top:.5rem">
                  <img src="{{ asset('storage/'. $profil->logo) }}" alt="logo" style="max-height:80px; border-radius:6px; border:1px solid #e5e7eb;">
                </div>
              </div>
            @endif
          </div>
        </div>
        {{-- ========== AKHIR KODE DARI _form.blade.php ========== --}}

        <button class="btn btn-primary btn-action mt-3">
            <i class="material-icons opacity-10 me-1">save</i>
            Update
        </button>
        <a href="{{ route('profil.index') }}" class="btn btn-secondary btn-action mt-3">
            <i class="material-icons opacity-10 me-1">undo</i>
            Batal
        </a>
        </form>
    </div>
  </div>
</div>
@endsection
