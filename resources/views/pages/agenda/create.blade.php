@extends('layouts.admin.app')
@section('page-title', 'Tambah Agenda')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">

            {{-- Header Pink (Primary) --}}
            <div class="card-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3 mb-0">
                    <i class="material-icons opacity-10 me-2 text-sm">event_note</i> Tambah Agenda Baru
                </h6>
            </div>

            <div class="card-body px-4 py-4">
                @if ($errors->any())
                    <div class="alert alert-danger text-white">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- SECTION 1: INFORMASI UTAMA --}}
                <div class="d-flex align-items-center mb-3">
                    <i class="material-icons text-primary me-2" style="font-size: 24px;">event_note</i>
                    <h6 class="mb-0 text-uppercase text-primary fw-bold">Informasi Agenda</h6>
                </div>

                <div class="card card-body border border-light shadow-none mb-4" style="background-color: #f8f9fa;">
                    <div class="row g-3">
                        {{-- Judul Agenda --}}
                        <div class="col-md-8">
                            <label class="form-label fw-bold text-dark">Judul Agenda <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="judul" class="form-control bg-white border px-3"
                                value="{{ old('judul') }}" required
                                placeholder="Contoh: Musyawarah Perencanaan Pembangunan">
                        </div>

                        {{-- Penyelenggara --}}
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-dark">Penyelenggara</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i
                                        class="material-icons text-sm">groups</i></span>
                                <input type="text" name="penyelenggara"
                                    class="form-control bg-white border border-start-0 px-2"
                                    value="{{ old('penyelenggara') }}" placeholder="Contoh: PKK / Karang Taruna">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SECTION 2: WAKTU & LOKASI --}}
                <div class="d-flex align-items-center mb-3 mt-4">
                    <i class="material-icons text-primary me-2" style="font-size: 24px;">schedule</i>
                    <h6 class="mb-0 text-uppercase text-primary fw-bold">Waktu & Lokasi</h6>
                </div>

                <div class="card card-body border border-light shadow-none mb-4" style="background-color: #f8f9fa;">
                    <div class="row g-3">
                        {{-- Tanggal Mulai --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark">Waktu Mulai <span
                                    class="text-danger">*</span></label>
                            <input type="datetime-local" name="tanggal_mulai" class="form-control bg-white border px-3"
                                value="{{ old('tanggal_mulai') }}" required>
                        </div>

                        {{-- Tanggal Selesai --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark">Waktu Selesai <span
                                    class="text-muted fw-normal">(Opsional)</span></label>
                            <input type="datetime-local" name="tanggal_selesai" class="form-control bg-white border px-3"
                                value="{{ old('tanggal_selesai') }}">
                        </div>

                        {{-- Lokasi --}}
                        <div class="col-md-12">
                            <label class="form-label fw-bold text-dark">Lokasi Kegiatan</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i
                                        class="material-icons text-sm">place</i></span>
                                <input type="text" name="lokasi"
                                    class="form-control bg-white border border-start-0 px-2" value="{{ old('lokasi') }}"
                                    placeholder="Contoh: Aula Kantor Desa">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SECTION 3: DETAIL & VISUAL --}}
                <div class="d-flex align-items-center mb-3 mt-4">
                    <i class="material-icons text-primary me-2" style="font-size: 24px;">description</i>
                    <h6 class="mb-0 text-uppercase text-primary fw-bold">Detail & Poster</h6>
                </div>

                <div class="card card-body border border-light shadow-none mb-4" style="background-color: #f8f9fa;">
                    <div class="row g-3">
                        {{-- Deskripsi --}}
                        <div class="col-md-7">
                            <label class="form-label fw-bold text-dark">Deskripsi Lengkap</label>
                            <textarea name="deskripsi" class="form-control bg-white border px-3" rows="5"
                                placeholder="Tuliskan susunan acara, catatan penting, atau informasi tambahan lainnya...">{{ old('deskripsi') }}</textarea>
                        </div>

                        {{-- Upload Poster --}}
                        <div class="col-md-5">
                            <label class="form-label fw-bold text-dark">Poster / Banner Agenda</label>
                            <div class="p-3 bg-white border rounded text-center mb-2">
                                <i class="material-icons text-secondary mb-2" style="font-size: 32px;">cloud_upload</i>
                                <p class="text-xs text-muted mb-0">Upload gambar poster kegiatan di sini</p>
                            </div>
                            <input type="file" name="poster" class="form-control bg-white border px-3" accept="image/*">
                            <small class="text-xs text-muted fst-italic mt-1 d-block"><i
                                    class="material-icons text-xs align-middle">info</i> Format JPG/PNG. Maksimal
                                2MB.</small>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end">
                    <a href="{{ route('agenda.index') }}" class="btn btn-secondary me-2">
                        <i class="material-icons opacity-10 me-1">undo</i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="material-icons opacity-10 me-1">save</i> Simpan
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
