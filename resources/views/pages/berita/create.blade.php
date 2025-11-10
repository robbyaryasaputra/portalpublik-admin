@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Berita</h1>
        <a href="{{ route('berita.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left fa-sm text-white-50 me-2"></i>Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('berita.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->kategori_id }}" {{ old('kategori_id') == $kategori->kategori_id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror"
                           id="judul" name="judul" value="{{ old('judul') }}" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Slug (Opsional)</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                           id="slug" name="slug" value="{{ old('slug') }}">
                    <small class="text-muted">Biarkan kosong untuk generate otomatis dari judul</small>
                    @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="isi_html" class="form-label">Isi Berita</label>
                    <textarea class="form-control @error('isi_html') is-invalid @enderror"
                              id="isi_html" name="isi_html" rows="10" required>{{ old('isi_html') }}</textarea>
                    @error('isi_html')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="penulis" class="form-label">Penulis (Opsional)</label>
                    <input type="text" class="form-control @error('penulis') is-invalid @enderror"
                           id="penulis" name="penulis" value="{{ old('penulis') }}">
                    @error('penulis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Publikasikan</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="terbit_at" class="form-label">Tanggal Terbit (Opsional)</label>
                    <input type="datetime-local" class="form-control @error('terbit_at') is-invalid @enderror"
                           id="terbit_at" name="terbit_at" value="{{ old('terbit_at') }}">
                    <small class="text-muted">Biarkan kosong untuk menggunakan waktu saat ini ketika dipublikasikan</small>
                    @error('terbit_at')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Simpan Berita</button>
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

    // Auto-generate slug from title
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
