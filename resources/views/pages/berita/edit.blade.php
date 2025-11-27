@extends('layouts.admin.app')
@section('page-title', 'Edit Berita')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header">
                <h4>Edit Berita</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('berita.update', ['beritum' => $item->berita_id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-panel">
    @php
        $judul = old('judul', $item->judul);
        $slug = old('slug', $item->slug);
        $kategori_id = old('kategori_id', $item->kategori_id);
        $penulis = old('penulis', $item->penulis);
        $status = old('status', $item->status);
        $terbit_at = old('terbit_at', $item->terbit_at ? \Carbon\Carbon::parse($item->terbit_at)->format('Y-m-d\TH:i') : '');
        $isi_html = old('isi_html', $item->isi_html);
    @endphp

    {{-- SECTION 1: INFORMASI DASAR --}}
    <div class="d-flex align-items-center mb-3">
        <i class="material-icons text-primary me-2" style="font-size: 24px;">article</i>
        <h6 class="mb-0 text-uppercase text-primary fw-bold">Informasi Berita</h6>
    </div>

    <div class="card card-body border border-light shadow-none mb-4" style="background-color: #f8f9fa;">
        <div class="row g-3">
            {{-- Judul --}}
            <div class="col-md-12">
                <label for="judul" class="form-label fw-bold text-dark">Judul Berita <span class="text-danger">*</span></label>
                <input id="judul" name="judul" type="text" class="form-control bg-white border px-3" value="{{ $judul }}" required placeholder="Masukkan judul berita utama...">
            </div>

            {{-- Slug --}}
            <div class="col-md-6">
                <label for="slug" class="form-label fw-bold text-dark">Slug / URL</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted">/berita/</span>
                    <input id="slug" name="slug" type="text" class="form-control bg-white border border-start-0 px-2" value="{{ $slug }}" placeholder="judul-berita-anda">
                </div>
                <small class="text-xs text-muted">Biarkan kosong untuk generate otomatis dari judul.</small>
            </div>

            {{-- Penulis --}}
            <div class="col-md-6">
                <label for="penulis" class="form-label fw-bold text-dark">Penulis</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="material-icons text-sm">person</i></span>
                    <input id="penulis" name="penulis" type="text" class="form-control bg-white border border-start-0 px-2" value="{{ $penulis }}" placeholder="Nama penulis berita">
                </div>
            </div>
        </div>
    </div>

    {{-- SECTION 2: PENGATURAN PUBLIKASI --}}
    <div class="d-flex align-items-center mb-3 mt-4">
        <i class="material-icons text-primary me-2" style="font-size: 24px;">tune</i>
        <h6 class="mb-0 text-uppercase text-primary fw-bold">Pengaturan Publikasi</h6>
    </div>

    <div class="card card-body border border-light shadow-none mb-4" style="background-color: #f8f9fa;">
        <div class="row g-3">
            {{-- Kategori --}}
            <div class="col-md-4">
                <label for="kategori_id" class="form-label fw-bold text-dark">Kategori <span class="text-danger">*</span></label>
                <select id="kategori_id" name="kategori_id" class="form-select bg-white border px-3" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategori as $kat)
                        <option value="{{ $kat->kategori_id }}" {{ $kategori_id == $kat->kategori_id ? 'selected' : '' }}>
                            {{ $kat->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Status --}}
            <div class="col-md-4">
                <label for="status" class="form-label fw-bold text-dark">Status</label>
                <select id="status" name="status" class="form-select bg-white border px-3">
                    <option value="draft" {{ $status == 'draft' ? 'selected' : '' }}>Draft (Konsep)</option>
                    <option value="published" {{ $status == 'published' ? 'selected' : '' }}>Published (Terbit)</option>
                </select>
            </div>

            {{-- Tanggal Terbit --}}
            <div class="col-md-4">
                <label for="terbit_at" class="form-label fw-bold text-dark">Jadwal Terbit <small class="fw-normal text-muted">(Opsional)</small></label>
                <input id="terbit_at" name="terbit_at" type="datetime-local" class="form-control bg-white border px-3" value="{{ $terbit_at }}">
            </div>
        </div>
    </div>

    {{-- SECTION 3: MEDIA & GALERI --}}
    <div class="d-flex align-items-center mb-3 mt-4">
        <i class="material-icons text-primary me-2" style="font-size: 24px;">image</i>
        <h6 class="mb-0 text-uppercase text-primary fw-bold">Media & Galeri</h6>
    </div>

    <div class="card card-body border border-light shadow-none mb-4" style="background-color: #f8f9fa;">
        <div class="row g-3">
            {{-- Cover Image --}}
            <div class="col-md-6">
                <label class="form-label fw-bold text-dark">Cover Berita</label>
                
                {{-- Preview Cover --}}
                @if ($item->cover)
                    <div class="d-flex align-items-center mb-2 p-2 bg-white border rounded">
                        <img src="{{ asset('storage/' . $item->cover) }}" class="rounded me-3 shadow-sm" style="width: 80px; height: 60px; object-fit: cover;">
                        <div class="d-flex flex-column">
                            <span class="text-xs fw-bold text-dark">Cover Saat Ini</span>
                            <span class="text-xs text-success"><i class="material-icons text-xs align-middle">check_circle</i> Tersimpan</span>
                        </div>
                    </div>
                @endif

                <input type="file" name="cover_image" class="form-control bg-white border px-3" accept="image/*">
                <small class="text-xs text-muted fst-italic">Upload baru untuk mengganti cover utama.</small>
            </div>

            {{-- Galeri Tambahan --}}
            <div class="col-md-6">
                <label class="form-label fw-bold text-dark">Galeri Foto Tambahan</label>
                <input type="file" name="gallery[]" class="form-control bg-white border px-3" multiple accept="image/*">
                <small class="text-xs text-muted fst-italic">Bisa pilih lebih dari satu foto sekaligus.</small>

                {{-- Preview Galeri --}}
                @if ($item->gallery->count() > 0)
                    <div class="mt-3 p-2 bg-white border rounded">
                        <p class="text-xs fw-bold mb-2 text-dark">Foto Galeri Tersimpan:</p>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach ($item->gallery as $gal)
                                <a href="{{ asset('storage/' . $gal->file_url) }}" target="_blank" class="d-block position-relative group-hover-overlay">
                                    <img src="{{ asset('storage/' . $gal->file_url) }}" class="rounded border" style="width: 50px; height: 50px; object-fit: cover;" title="Klik untuk lihat">
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- SECTION 4: ISI BERITA --}}
    <div class="d-flex align-items-center mb-3 mt-4">
        <i class="material-icons text-primary me-2" style="font-size: 24px;">wysiwyg</i>
        <h6 class="mb-0 text-uppercase text-primary fw-bold">Konten Berita</h6>
    </div>

    <div class="card card-body border border-light shadow-none mb-4" style="background-color: #f8f9fa;">
        <div class="row">
            <div class="col-md-12">
                <textarea id="isi_html" name="isi_html" class="form-control bg-white border px-3" rows="15" placeholder="Tuliskan isi berita lengkap di sini...">{{ $isi_html }}</textarea>
                <small class="text-muted text-xs mt-2 d-block">* Gunakan toolbar di atas editor untuk memformat teks.</small>
            </div>
        </div>
    </div>

</div>

                        <div class="mt-3">
                            <button class="btn btn-primary btn-action mt-3">
                                <i class="material-icons opacity-10 me-1">save</i>
                                Update
                            </button>
                            <a href="{{ route('berita.index') }}" class="btn btn-secondary btn-action mt-3">
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
