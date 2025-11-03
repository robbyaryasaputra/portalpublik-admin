@extends('layouts.admin.app')
@section('page-title', 'Edit Warga')

@section('content')
{{-- Blok <style> dipindahkan ke css.blade.php --}}

<div class="container-fluid py-4">
  <div class="card">
    <div class="card-header"><h4>Edit Warga</h4></div>
    <div class="card-body">
      @if($errors->any())<div class="alert alert-danger"><ul>@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul></div>@endif

      <form action="{{ route('warga.update', $warga) }}" method="POST" class="warga-form">
            @csrf
            @method('PUT')

            <div class="row">
              <div class="mb-3 col-6">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', isset($warga) ? $warga->nama : '') }}" class="form-control" placeholder="Tulis nama lengkap..." required>
              </div>
              <div class="mb-3 col-6">
                <label class="form-label">NIK</label>
                <input type="text" name="no_ktp" value="{{ old('no_ktp', isset($warga) ? $warga->no_ktp : '') }}" class="form-control" placeholder="16 digit NIK..." required>
              </div>
              <div class="mb-3 col-6">
                <label class="form-label">No. KK</label>
                <input type="text" name="no_kk" value="{{ old('no_kk', isset($warga) ? $warga->no_kk : '') }}" class="form-control" placeholder="16 digit No. KK...">
              </div>

              {{-- [AWAL PERUBAHAN] - Memperbaiki logika old() helper untuk dropdown --}}
              <div class="mb-3 col-6">
                <label class="form-label">Jenis Kelamin</label>
                @php
                  $jenis_kelamin = old('jenis_kelamin', isset($warga) ? $warga->jenis_kelamin : '');
                @endphp
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="" disabled {{ $jenis_kelamin == '' ? 'selected' : '' }}>-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki" {{ $jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
              </div>
              {{-- [AKHIR PERUBAHAN] --}}

              <div class="mb-3 col-6">
                <label class="form-label">Agama</label>
                <input type="text" name="agama" value="{{ old('agama', isset($warga) ? $warga->agama : '') }}" class="form-control" placeholder="Contoh: Islam">
              </div>
              <div class="mb-3 col-6">
                <label class="form-label">Pekerjaan</label>
                <input type="text" name="pekerjaan" value="{{ old('pekerjaan', isset($warga) ? $warga->pekerjaan : '') }}" class="form-control" placeholder="Contoh: Wiraswasta">
              </div>
              <div class="mb-3 col-6">
                <label class="form-label">Telp</label>
                <input type="text" name="telp" value="{{ old('telp', isset($warga) ? $warga->telp : '') }}" class="form-control" placeholder="0812...">
              </div>
              <div class="mb-3 col-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email', isset($warga) ? $warga->email : '') }}" class="form-control" placeholder="@contoh.com">
              </div>
            </div>

            <button class="btn btn-primary btn-action mt-3">
                <i class="material-icons opacity-10 me-1">save</i>
                Update
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
