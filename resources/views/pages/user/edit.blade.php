@extends('layouts.admin.app')

@section('page-title', 'Edit User')

@section('content')

{{-- Blok <style> dipindahkan ke css.blade.php --}}

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header"><h6>Edit User</h6></div>
        <div class="card-body">
          @if($errors->any())<div class="alert alert-danger"><ul>@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul></div>@endif

          <form action="{{ route('user.update', $item->id) }}" method="POST" class="form-dark-pink">
            @csrf @method('PUT')

            {{-- ========== AWAL KODE DARI _form.blade.php ========== --}}
            @php
                // Saat edit, $item pasti ada
                $name = old('name', $item->name);
                $email = old('email', $item->email);
            @endphp

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" name="name" type="text" class="form-control" value="{{ $name }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" class="form-control" value="{{ $email }}" required>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" class="form-control" placeholder="Isi untuk ganti password">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="Ulangi password baru">
                    </div>
                </div>
            </div>
            {{-- ========== AKHIR KODE DARI _form.blade.php ========== --}}

            {{-- Menambahkan tombol Update --}}
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="material-icons opacity-10 me-1">save</i>
                    Update
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
