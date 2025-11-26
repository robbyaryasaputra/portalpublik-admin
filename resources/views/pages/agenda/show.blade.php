@extends('layouts.admin.app')
@section('page-title', 'Detail Agenda')

@section('content')
<div class="container-fluid py-4">
    
    {{-- HEADER NAVIGASI --}}
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h6 class="mb-1 fw-bold">Detail Agenda Kegiatan</h6>
                <p class="text-xs text-secondary mb-0">Informasi lengkap jadwal dan lokasi.</p>
            </div>
            <div>
                <a href="{{ route('agenda.edit', $agenda->agenda_id) }}" class="btn btn-primary btn-sm mb-0 me-2">
                <i class="material-icons opacity-10 me-1">edit</i> Edit
                </a>
                <a href="{{ route('agenda.index') }}" class="btn btn-secondary btn-sm mb-0">
                    <i class="material-icons opacity-10 me-1">arrow_back</i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- KOLOM KIRI: POSTER & WAKTU --}}
        <div class="col-lg-4 mb-4">
            {{-- Kartu Poster --}}
            <div class="card mb-4 shadow-sm">
                <div class="card-body p-3 text-center">
                    @if($agenda->poster)
                        <img src="{{ asset('storage/' . $agenda->poster) }}" class="img-fluid border-radius-lg shadow-sm" style="max-height: 400px; width: 100%; object-fit: cover;" alt="Poster">
                    @else
                        <div class="bg-gray-100 border-radius-lg d-flex align-items-center justify-content-center flex-column" style="height: 300px;">
                            <i class="material-icons text-secondary opacity-4 text-6xl">event</i>
                            <span class="text-secondary text-sm mt-2">Tidak ada poster</span>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Kartu Waktu --}}
            <div class="card shadow-sm">
                <div class="card-header p-3 pb-0">
                    <h6 class="mb-0 fw-bold text-sm">Waktu Pelaksanaan</h6>
                </div>
                <div class="card-body p-3">
                    <div class="timeline timeline-one-side">
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="material-icons text-success text-gradient">play_circle</i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">Mulai</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                    {{ $agenda->tanggal_mulai->format('d F Y') }}
                                </p>
                                <p class="text-secondary text-xs mt-0">
                                    Pukul {{ $agenda->tanggal_mulai->format('H:i') }} WIB
                                </p>
                            </div>
                        </div>
                        <div class="timeline-block">
                            <span class="timeline-step">
                                <i class="material-icons text-danger text-gradient">stop_circle</i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">Selesai</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                    @if($agenda->tanggal_selesai)
                                        {{ $agenda->tanggal_selesai->format('d F Y') }}
                                    @else
                                        -
                                    @endif
                                </p>
                                <p class="text-secondary text-xs mt-0">
                                    @if($agenda->tanggal_selesai)
                                        Pukul {{ $agenda->tanggal_selesai->format('H:i') }} WIB
                                    @else
                                        (Sampai Selesai)
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: DETAIL INFO --}}
        <div class="col-lg-8">
            <div class="card h-100 shadow-sm">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex align-items-center">
                        <span class="badge bg-gradient-primary me-3">Agenda</span>
                        <h4 class="mb-0 fw-bold text-dark">{{ $agenda->judul }}</h4>
                    </div>
                </div>
                <div class="card-body p-3">
                    
                    {{-- Lokasi & Penyelenggara --}}
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center p-3 border border-radius-lg bg-gray-50">
                                <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons text-dark text-sm opacity-10">place</i>
                                </div>
                                <div>
                                    <span class="d-block text-xs text-secondary text-uppercase fw-bold">Lokasi</span>
                                    <span class="text-sm font-weight-bold text-dark">{{ $agenda->lokasi ?? 'Belum ditentukan' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center p-3 border border-radius-lg bg-gray-50">
                                <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons text-dark text-sm opacity-10">groups</i>
                                </div>
                                <div>
                                    <span class="d-block text-xs text-secondary text-uppercase fw-bold">Penyelenggara</span>
                                    <span class="text-sm font-weight-bold text-dark">{{ $agenda->penyelenggara ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-2">
                        <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Deskripsi Kegiatan</h6>
                        <div class="text-sm text-dark opacity-8" style="line-height: 1.8; white-space: pre-line;">
                            {{ $agenda->deskripsi ?? 'Tidak ada deskripsi detail.' }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection