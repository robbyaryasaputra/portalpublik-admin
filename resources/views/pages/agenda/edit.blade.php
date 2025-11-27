@extends('layouts.admin.app')
@section('page-title', 'Edit Agenda')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">

            {{-- Header Pink (Primary) --}}
            <div class="card-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex align-items-center">
                <i class="material-icons opacity-10 text-white ps-3 me-2">edit</i>
                <h6 class="text-white text-capitalize mb-0">Edit Agenda: {{ $agenda->judul }}</h6>
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

                <form action="{{ route('agenda.update', $agenda->agenda_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

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
                                    value="{{ old('judul', $agenda->judul) }}" required
                                    placeholder="Contoh: Rapat Koordinasi Desa">
                            </div>

                            {{-- Penyelenggara --}}
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-dark">Penyelenggara</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i
                                            class="material-icons text-sm">groups</i></span>
                                    <input type="text" name="penyelenggara"
                                        class="form-control bg-white border border-start-0 px-2"
                                        value="{{ old('penyelenggara', $agenda->penyelenggara) }}"
                                        placeholder="Contoh: Karang Taruna">
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
                                    value="{{ old('tanggal_mulai', $agenda->tanggal_mulai ? $agenda->tanggal_mulai->format('Y-m-d\TH:i') : '') }}"
                                    required>
                            </div>

                            {{-- Tanggal Selesai --}}
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark">Waktu Selesai <span
                                        class="text-muted fw-normal">(Opsional)</span></label>
                                <input type="datetime-local" name="tanggal_selesai"
                                    class="form-control bg-white border px-3"
                                    value="{{ old('tanggal_selesai', $agenda->tanggal_selesai ? $agenda->tanggal_selesai->format('Y-m-d\TH:i') : '') }}">
                            </div>

                            {{-- Lokasi --}}
                            <div class="col-md-12">
                                <label class="form-label fw-bold text-dark">Lokasi Kegiatan</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i
                                            class="material-icons text-sm">place</i></span>
                                    <input type="text" name="lokasi"
                                        class="form-control bg-white border border-start-0 px-2"
                                        value="{{ old('lokasi', $agenda->lokasi) }}" placeholder="Contoh: Aula Balai Desa">
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
                                <textarea name="deskripsi" class="form-control bg-white border px-3" rows="6"
                                    placeholder="Jelaskan detail kegiatan, susunan acara, atau catatan penting lainnya...">{{ old('deskripsi', $agenda->deskripsi) }}</textarea>
                            </div>

                            {{-- Upload Poster --}}
                            <div class="col-md-5">
                                <label class="form-label fw-bold text-dark">Poster / Flyer</label>

                                {{-- Preview Poster Lama --}}
                                @if ($agenda->poster)
                                    <div class="d-flex align-items-center mb-2 p-2 bg-white border rounded">
                                        <img src="{{ asset('storage/' . $agenda->poster) }}" class="rounded me-2"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                        <div class="d-flex flex-column">
                                            <span class="text-xs fw-bold text-dark">Poster Saat Ini</span>
                                            <a href="{{ asset('storage/' . $agenda->poster) }}" target="_blank"
                                                class="text-xs text-primary text-decoration-underline">Lihat Gambar
                                                Penuh</a>
                                        </div>
                                    </div>
                                @else
                                    <div class="alert alert-light text-xs border border-dashed mb-2 text-center text-muted">
                                        <i class="material-icons text-sm d-block mb-1">image_not_supported</i>
                                        Belum ada poster diupload
                                    </div>
                                @endif

                                <input type="file" name="poster" class="form-control bg-white border px-3"
                                    accept="image/*">
                                <small class="text-xs text-muted d-block mt-1">
                                    <i class="material-icons text-xs align-middle">info</i> Upload untuk mengganti poster
                                    lama.
                                </small>
                            </div>
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="mt-4 d-flex justify-content-end">
                        <a href="{{ route('agenda.index') }}" class="btn btn-secondary me-2">
                            <i class="material-icons opacity-10 me-1">undo</i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="material-icons opacity-10 me-1">save</i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
