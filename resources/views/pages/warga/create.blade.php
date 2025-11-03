@extends('layouts.admin.app')
@section('page-title', 'Tambah Warga')

@section('content')
{{-- Blok <style> dipindahkan ke css.blade.php --}}

<div class="container-fluid py-4">
  <div class="card">
    <div class="card-header"><h4>Tambah Warga</h4></div>
    <div class="card-body">
      @if($errors->any())<div class="alert alert-danger"><ul>@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul></div>@endif

      <form action="{{ route('warga.store') }}" method="POST" class="warga-form">
            @csrf

            <div class="row">
              <div class="mb-3 col-6">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" value="{{ old('nama') }}" class="form-control" placeholder="Tulis nama lengkap..." required>
              </div>
              <div class="mb-3 col-6">
                <label class="form-label">NIK</label>
                <input type="text" name="no_ktp" value="{{ old('no_ktp') }}" class="form-control" placeholder="16 digit NIK..." required>
              </div>
              <div class="mb-3 col-6">
                <label class="form-label">No. KK</label>
                <input type="text" name="no_kk" value="{{ old('no_kk') }}" class="form-control" placeholder="16 digit No. KK...">
              </div>
              <div class="mb-3 col-6">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
              </div>

              <div class="mb-3 col-6">
                <label class="form-label">Agama</label>
                <input type="text" name="agama" value="{{ old('agama') }}" class="form-control" placeholder="Contoh: Islam">
              </div>
              <div class="mb-3 col-6">
                <label class="form-label">Pekerjaan</label>
                <input type="text" name="pekerjaan" value="{{ old('pekerjaan') }}" class="form-control" placeholder="Contoh: Wiraswasta">
              </div>
              <div class="mb-3 col-6">
                <label class="form-label">Telp</label>
                <input type="text" name="telp" value="{{ old('telp') }}" class="form-control" placeholder="0812...">
              </div>
              <div class="mb-3 col-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="@contoh.com">
              </div>
            </div>

            <button type="submit" class="btn btn-primary btn-action mt-3">
                <i class="material-icons opacity-10 me-1">save</i>
                Simpan
            </button>
            <a href="{{ route('warga.index') }}" class="btn btn-secondary btn-action mt-3">
                <i class="material-icons opacity-10 me-1">undo</i>
                Batal
            </a>
            </form>
    </div>
  </div>
</div>
@endsection
