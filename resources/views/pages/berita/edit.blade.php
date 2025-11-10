@extends('layouts.admin.app')
@section('page-title', 'Edit Berita')

@section('content')
<div class="container-fluid py-4">
  <div class="card">
    <div class="card-header"><h4>Edit Berita</h4></div>
    <div class="card-body">
      @if($errors->any())<div class="alert alert-danger"><ul>@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul></div>@endif

            <form action="{{ route('berita.update', ['beritum' => $item->berita_id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-panel">

                {{-- ========== FORMULIR BERITA ========== --}}
                @php
                    // Variabel $item DI-SET dari controller saat 'edit'
                    $judul = old('judul', isset($item) ? $item->judul : '');
                    $slug = old('slug', isset($item) ? $item->slug : '');
                    $kategori_id = old('kategori_id', isset($item) ? $item->kategori_id : '');
                    $penulis = old('penulis', isset($item) ? $item->penulis : '');
                    $status = old('status', isset($item) ? $item->status : 'draft');
                    // Format tanggal untuk input datetime-local
                    $terbit_at = old('terbit_at', isset($item) && $item->terbit_at ? \Carbon\Carbon::parse($item->terbit_at)->format('Y-m-d\TH:i') : '');
                    $isi_html = old('isi_html', isset($item) ? $item->isi_html : '');
                @endphp

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="judul">Judul Berita</label>
                            <input id="judul" name="judul" type="text" class="form-control" value="{{ $judul }}" placeholder="Tulis judul berita di sini..." required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="slug">Slug (opsional)</label>
                            <input id="slug" name="slug" type="text" class="form-control" value="{{ $slug }}" placeholder="[Otomatis jika dikosongkan]">
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kategori_id">Kategori</label>
                            <select name="kategori_id" id="kategori_id" class="form-control" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategori as $kat)
                                    <option value="{{ $kat->kategori_id }}" {{ $kategori_id == $kat->kategori_id ? 'selected' : '' }}>
                                        {{ $kat->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="penulis">Penulis (opsional)</label>
                            <input id="penulis" name="penulis" type="text" class="form-control" value="{{ $penulis }}" placeholder="Nama penulis">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="draft" {{ $status == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ $status == 'published' ? 'selected' : '' }}>Published</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="terbit_at">Tanggal Terbit (opsional)</label>
                            <input id="terbit_at" name="terbit_at" type="datetime-local" class="form-control" value="{{ $terbit_at }}">
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="isi_html">Isi Berita</label>
                            <textarea id="isi_html" name="isi_html" class="form-control" rows="10" placeholder="Tulis isi berita di sini...">{{ $isi_html }}</textarea>
                            <small>Disarankan menggunakan Rich Text Editor (seperti CKEditor/TinyMCE) untuk field ini.</small>
                        </div>
                    </div>
                </div>
                {{-- ========== AKHIR FORMULIR BERITA ========== --}}

                <div class="mt-3">
                        <button class="btn btn-primary btn-action">
                            <i class="material-icons opacity-10 me-1">save</i>
                            Update
                        </button>
                        <a href="{{ route('berita.index') }}" class="btn btn-secondary">
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
