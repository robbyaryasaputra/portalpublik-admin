@extends('layouts.admin.app')
@section('page-title', 'Edit Kategori Berita')

@section('content')

{{-- Blok <style> dipindahkan ke css.blade.php --}}

<div class="container-fluid py-4">
  <div class="card">
    <div class="card-header"><h4>Edit Kategori Berita</h4></div>
    <div class="card-body">
      @if($errors->any())<div class="alert alert-danger"><ul>@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul></div>@endif

            <form action="{{ route('kategori-berita.update', ['kategori_beritum' => $item->kategori_id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-panel">

        {{-- ========== AWAL KODE DARI _form.blade.php ========== --}}
        @php
            $nama = old('nama', isset($item) ? $item->nama : '');
            $slug = old('slug', isset($item) ? $item->slug : '');
            $deskripsi = old('deskripsi', isset($item) ? $item->deskripsi : '');
        @endphp

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    {{-- Ditambahkan placeholder --}}
                    <input id="nama" name="nama" type="text" class="form-control" value="{{ $nama }}" placeholder="Contoh: Berita Desa" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="slug">Slug (opsional)</label>
                    {{-- Ditambahkan placeholder --}}
                    <input id="slug" name="slug" type="text" class="form-control" value="{{ $slug }}" placeholder="Contoh: berita-desa">
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="deskripsi">Deskripsi (opsional)</label>
                    {{-- Ditambahkan placeholder --}}
                    <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4" placeholder="Tulis deskripsi singkat kategori di sini...">{{ $deskripsi }}</textarea>
                </div>
            </div>
        </div>
        {{-- ========== AKHIR KODE DARI _form.blade.php ========== --}}

                <div class="mt-3">
                        <button class="btn btn-primary btn-action">
                            <i class="material-icons opacity-10 me-1">save</i>
                            Update
                        </button>
                        <a href="{{ route('kategori-berita.index') }}" class="btn btn-secondary">
                            <i class="material-icons opacity-10 me-1">undo</i>
                            Batal
                        </a>
                </div>
                </div>
            </form>
    </div>
  </div>
</div>
@endsection
