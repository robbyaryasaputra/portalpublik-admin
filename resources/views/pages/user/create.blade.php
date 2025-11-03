@extends('layouts.admin.app')

@section('page-title', 'Tambah User')

@section('content')

{{-- Blok <style> dipindahkan ke css.blade.php --}}

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header"><h6>Tambah User</h6></div>
        <div class="card-body">
          @if($errors->any())<div class="alert alert-danger"><ul>@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul></div>@endif

          <form action="{{ route('user.store') }}" method="POST" class="form-dark-pink">
            {{-- ========== AWAL KODE DARI _form.blade.php ========== --}}
            @csrf
            @php
                // Saat create, $item tidak ada, jadi 'isset($item)' akan false
                $name = old('name', '');
                $email = old('email', '');
            @endphp

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" name="name" type="text" class="form-control" value="{{ $name }}" placeholder="Contoh: Admin Desa" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" class="form-control" value="{{ $email }}" placeholder="admin@contoh.com" required>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" class="form-control" placeholder="Minimal 8 karakter" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="Ulangi password" required>
                    </div>
                </div>
            </div>

            {{-- Menambahkan tombol Simpan --}}
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="material-icons opacity-10 me-1">save</i>
                    Simpan
                </button>
                <a href="{{ route('user.index') }}" class="btn btn-secondary">
                    <i class="material-icons opacity-10 me-1">undo</i>
                    Batal
                </a>
            </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
