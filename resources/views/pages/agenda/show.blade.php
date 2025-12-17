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
                <div class="card mb-4 shadow-sm overflow-hidden">
                    <div class="card-body p-3 text-center">
                        @if ($agenda->poster)
                            {{-- Tambahkan pembungkus anchor dan class img-container --}}
                            <a href="{{ asset('storage/' . $agenda->poster) }}" target="_blank"
                                class="d-block border-radius-lg overflow-hidden">
                                <img src="{{ asset('storage/' . $agenda->poster) }}"
                                    class="img-fluid border-radius-lg shadow-sm hover-zoom"
                                    style="max-height: 400px; width: 100%; object-fit: cover; transition: transform 0.4s ease, filter 0.4s ease;"
                                    alt="Poster">
                            </a>
                        @else
                            <div class="bg-gray-100 border-radius-lg d-flex align-items-center justify-content-center flex-column"
                                style="height: 300px;">
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
                                        @if ($agenda->tanggal_selesai)
                                            {{ $agenda->tanggal_selesai->format('d F Y') }}
                                        @else
                                            -
                                        @endif
                                    </p>
                                    <p class="text-secondary text-xs mt-0">
                                        @if ($agenda->tanggal_selesai)
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
                {{-- Menghapus h-100 agar tinggi kartu mengikuti jumlah konten (tidak ada sisa kosong di bawah) --}}
                <div class="card shadow-sm border-radius-lg">
                    <div class="card-header pb-0 p-3 bg-transparent">
                        <div class="d-flex align-items-center">
                            <span class="badge bg-gradient-primary shadow-primary me-3">Agenda</span>
                            <h4 class="mb-0 fw-bold text-dark">{{ $agenda->judul }}</h4>
                        </div>
                        <hr class="horizontal dark mt-3 mb-0">
                    </div>

                    <div class="card-body p-3">
                        {{-- Lokasi & Penyelenggara: Menggunakan bg-light dan hover effect untuk tampilan padat --}}
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div
                                    class="info-horizontal border border-radius-lg bg-gray-100 p-3 d-flex align-items-center shadow-none transition-all">
                                    <div
                                        class="icon icon-shape icon-sm shadow-sm border-radius-md bg-white text-center me-3 d-flex align-items-center justify-content-center">
                                        <i class="material-icons text-primary text-sm opacity-10">place</i>
                                    </div>
                                    <div>
                                        <span
                                            class="d-block text-xxs text-secondary text-uppercase fw-bold mb-1">Lokasi</span>
                                        <span class="text-sm font-weight-bold text-dark d-block" style="line-height: 1.2;">
                                            {{ $agenda->lokasi ?? 'Belum ditentukan' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="info-horizontal border border-radius-lg bg-gray-100 p-3 d-flex align-items-center shadow-none transition-all">
                                    <div
                                        class="icon icon-shape icon-sm shadow-sm border-radius-md bg-white text-center me-3 d-flex align-items-center justify-content-center">
                                        <i class="material-icons text-primary text-sm opacity-10">groups</i>
                                    </div>
                                    <div>
                                        <span
                                            class="d-block text-xxs text-secondary text-uppercase fw-bold mb-1">Penyelenggara</span>
                                        <span class="text-sm font-weight-bold text-dark d-block" style="line-height: 1.2;">
                                            {{ $agenda->penyelenggara ?? '-' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Deskripsi: Menggunakan border putus-putus atau solid agar area teks terlihat penuh --}}
                        <div class="mb-0">
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3 d-flex align-items-center">
                                <i class="material-icons text-xs me-1 text-primary">description</i> Deskripsi Kegiatan
                            </h6>

                            <div class="p-3 border border-radius-lg bg-white shadow-none">
                                <div class="text-sm text-dark opacity-8" style="line-height: 1.6; white-space: pre-line;">
                                    @if ($agenda->deskripsi)
                                        {{ $agenda->deskripsi }}
                                    @else
                                        <span class="text-muted fst-italic">Tidak ada deskripsi detail untuk agenda
                                            ini.</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Footer info untuk mengisi bagian paling bawah secara rapi --}}
                        <div class="mt-3 opacity-6 d-flex align-items-center">
                            <i class="material-icons text-xxs me-1">update</i>
                            <p class="text-xxs mb-0">Terakhir diperbarui pada:
                                {{ $agenda->updated_at->translatedFormat('d F Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
