@extends('layouts.admin.app')
@section('page-title', 'Edit Berita')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header"><h4>Edit Berita</h4></div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('berita.update', $berita) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-panel">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kategori_id">Kategori</label>
                            <select name="kategori_id" id="kategori_id" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->kategori_id }}"
                                        {{ (old('kategori_id') ?? $berita->kategori_id) == $kategori->kategori_id ? 'selected' : '' }}>
                                        {{ $kategori->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="penulis">Penulis (opsional)</label>
                            <input type="text" class="form-control" id="penulis" name="penulis" 
                                   value="{{ old('penulis') ?? $berita->penulis }}"
                                   placeholder="Nama penulis berita">
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" 
                                   value="{{ old('judul') ?? $berita->judul }}" 
                                   placeholder="Judul berita" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="slug">Slug (opsional)</label>
                            <input type="text" class="form-control" id="slug" name="slug" 
                                   value="{{ old('slug') ?? $berita->slug }}"
                                   placeholder="Akan dibuat otomatis jika kosong">
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="isi_html">Isi Berita</label>
                            <textarea class="form-control" id="isi_html" name="isi_html" 
                                      rows="10" required 
                                      placeholder="Tulis isi berita di sini...">{{ old('isi_html') ?? $berita->isi_html }}</textarea>
                        </div>
                    </div>
                </div>

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

@push('scripts')
<script>
    // Initialize CKEditor for rich text editing
    ClassicEditor
        .create(document.querySelector('#isi_html'))
        .catch(error => {
            console.error(error);
        });

    // Auto-generate slug from title if slug is empty
    document.getElementById('judul').addEventListener('input', function() {
        if (!document.getElementById('slug').value) {
            document.getElementById('slug').value = this.value
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/(^-|-$)/g, '');
        }
    });
</script>
@endpush
@endsection
