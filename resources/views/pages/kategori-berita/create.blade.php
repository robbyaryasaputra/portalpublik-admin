@extends('layouts.admin.app')

@section('page-title', 'Tambah Kategori Berita')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6>Tambah Kategori Baru</h6>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Blok <style> dipindahkan ke css.blade.php --}}

                    <form action="{{ route('kategori-berita.store') }}" method="POST">
                        <div class="form-panel">
                        {{-- ========== AWAL KODE DARI _form.blade.php ========== --}}
                        @csrf

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
                                    <label for="slug">Slug </label>
                                    {{-- Ditambahkan placeholder --}}
                                    <input id="slug" name="slug" type="text" class="form-control" value="{{ $slug }}" placeholder="Contoh: berita-desa">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi </label>
                                    {{-- Ditambahkan placeholder --}}
                                    <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4" placeholder="Tulis deskripsi singkat kategori di sini...">{{ $deskripsi }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary btn-action">
                                <i class="material-icons opacity-10 me-1">save</i>
                                Simpan
                            </button>
                            <a href="{{ route('kategori-berita.index') }}" class="btn btn-secondary">
                                <i class="material-icons opacity-10 me-1">undo</i>
                                Batal
                            </a>
                        </div>
                        </div>
                        {{-- ========== AKHIR KODE DARI _form.blade.php ========== --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
